<?php
use core\controllerHelper;
use models\Servico;
class servicosController extends controllerHelper{
    public function viewCadastrar(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('cadastro-servicos', $data);
    }

    public function apiBuscarPorCategoria(){
        $model = new Servico();
        $idCategoria = $this->post('idCategoria');

        if(!empty($idCategoria)){
            $this->send(200, ['servicos' => $model->buscarPorCategoria($idCategoria)]);
        }
    }

    

}