<?php
use core\controllerHelper;
use models\validators\Admin as AdminValidator;
use models\Admin;
use auth\Admin as AdminAuth;
class adminController extends controllerHelper{
    public function viewLogin(){
        $this->loadView('login', array());
    }

    public function viewCadastrar(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('cadastro-admin', $data);
    }

    public function apiCadastrar(){
        $data = $this->post();

        $adminValidator = new AdminValidator(AdminValidator::$CRIANDO);
        $adminValidator->validate($data);

        $Model = new Admin();

        if(!empty($adminValidator->getMessages())){
            $this->send(400, ['errors' => $adminValidator->getMessages()]);
        }else{
            $id = $Model->cadastrar($_POST);
            if(!is_bool($id)){
                $this->send(200, ['admin' => $Model->buscar($id)]);
            }else{
                $this->send(400, ['error' => "Erro na criação, tente novamente mais tarde!"]);
            }
        }
    }

    public function apiListar(){
        $Model = new Admin();

        $admins = $Model->buscar();

        $this->send(200, ['admins' => $admins]);
    }

    public function apiLogin(){
        $data = $this->post();

        $auth = new AdminAuth();
        $login = $auth->login($data);

        if(is_bool($login) && $login === true){
            $this->send(200);
        }else {
            $this->send(400, ['errors' => $login]);
        }
    }

    public function viewAlterarAdmin(){
        $admin = $this->isLogged();
        $data['component'] = $admin;

        $this->loadView('perfil', $data);
    }

    public function apiBuscar(){
        $admin = $this->isLogged();

        $this->send(200, ['admin' => $admin]);
    }
}