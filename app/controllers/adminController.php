<?php
use core\controllerHelper;
class adminController extends controllerHelper{
    public function login(){
        $this->loadView('login', array());
    }

    public function viewCadastrar(){
        $this->loadView('cadastro-admin', array());
    }

    public function apiCadastrar(){
        $data = $this->post();


    }
}