<?php
class loginController extends controllerHelper{
    public function index(){
        $this->loadView('login', array());
    }

    public function home(){
        echo "olá mundo";
        // $this->loadTemplate('home', $data);
    }
}