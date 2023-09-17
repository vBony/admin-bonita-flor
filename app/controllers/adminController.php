<?php
use core\controllerHelper;
use models\validators\Admin as AdminValidator;
use models\Admin;
class adminController extends controllerHelper{
    public function login(){
        $this->loadView('login', array());
    }

    public function viewCadastrar(){
        $this->loadView('cadastro-admin', array());
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
}