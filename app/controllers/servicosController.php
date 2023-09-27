<?php
use core\controllerHelper;
use core\modelHelper;
use models\Categoria;
use models\Servico as Model;
use models\validators\Servico as Validator;

class servicosController extends controllerHelper{
    public function apiIndex(){
        $admin = $this->isLogged();

        $model = new Model();
        $modelCategoria = new Categoria();
        
        $response['lista']['categorias'] = $modelCategoria->buscar();
        $this->send(200, $response);
    }

    public function viewCadastrar(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('cadastro-servicos', $data);
    }

    public function apiBuscarPorCategoria(){
        $model = new Model();
        $idCategoria = $this->post('idCategoria');

        if(!empty($idCategoria)){
            $this->send(200, ['servicos' => $model->buscarPorCategoria($idCategoria)]);
        }
    }

    public function apiCadastrar(){
        $validator = new Validator(modelHelper::$CRIANDO);
        $model = new Model();

        $admin = $this->isLogged();
        $data = $this->post();

        $validator->validate($data);

        if(!empty($validator->getMessages())){
            $this->send(400, ["errors"=>$validator->getMessages()]);
        }else {
            if($model->salvar($data)){
                $this->send(200, ['servicos' => $model->buscarPorCategoria($data["idCategoria"])]);
            }else{
                $this->send(500);
            }
        }
    }
}