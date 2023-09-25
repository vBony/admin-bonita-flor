<?php
use core\controllerHelper;
use models\Categoria;
use models\Servico as Model;
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

    

}