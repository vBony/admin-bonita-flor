<?php
class adminController extends controllerHelper{
    public function login(){
        $this->loadView('login', array());
    }

    public function home(){
        echo "olá mundo";
        // $this->loadTemplate('home', $data);
    }
}