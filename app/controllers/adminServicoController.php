<?php
use core\controllerHelper;
use models\AdminServico;
use models\validators\AdminServico as Validator;

class adminServicoController extends controllerHelper{
    public function index(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('home', $data);
    }

    public function apiCadastrar(){
        $admin = $this->isLogged();

        $validator = new Validator();
        $AdminServico = new AdminServico();

        $data = $this->post();
        $data['idAdmin'] = $admin['id'];
        $validator->validate($data);

        if(!empty($validator->getMessages())){
            $message['errors'] = $validator->getMessages();
            $this->send('400', $message);
        }else{
            if($AdminServico->salvar($data) === true){
                $servicos = $AdminServico->buscarPorAdmin($admin['id']);
                $this->send('200', ['adminServicos' => $servicos]);
            }
        }
    }

    public function apiExcluir(){
        $admin = $this->isLogged();
        $model = new AdminServico();
        $sucesso = false;

        $id = $this->post('id');

        if(!empty($id)){
            $adminServico = $model->buscarPorId($id, $admin['id']);

            if(!empty($adminServico)){
                $sucesso = $model->excluir($id);
            }
        }

        if($sucesso){
            $this->send(200);
        }else{
            $this->send(400);
        }
        

    }
}