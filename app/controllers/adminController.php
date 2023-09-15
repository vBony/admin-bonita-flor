<?php
class adminController extends controllerHelper{
    public function login(){
        $this->loadView('login', array());
    }

    public function cadastrar(){
        $this->loadView('cadastro-admin', array());
    }
}