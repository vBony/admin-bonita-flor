<?php
use core\controllerHelper;
use auth\Admin;
use models\Admin as ModelAdmin;
class servicosController extends controllerHelper{
    public function viewCadastrar(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('cadastro-servicos', $data);
    }

}