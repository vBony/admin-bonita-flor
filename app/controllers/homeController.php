<?php
use core\controllerHelper;
class homeController extends controllerHelper{
    public function index(){

        $this->loadView('home', array());
    }

    public function home(){
        echo "olá mundo";
        // $this->loadTemplate('home', $data);
    }
}