<?php
use core\controllerHelper;
use auth\Admin;
use models\Admin as ModelAdmin;
class servicosController extends controllerHelper{
    public function viewCadastrar(){
        $auth = new Admin();
        $auth->isLogged();

        $idAdmin = $auth->getIdUserLogged();

        $admin = new ModelAdmin();
        $admin = $admin->buscar($idAdmin);

        $data['component'] = $admin;

        $this->loadView('cadastro-servicos', $data);
    }

}