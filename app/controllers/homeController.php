<?php
use core\controllerHelper;
use auth\Admin;
use models\Admin as ModelAdmin;
class homeController extends controllerHelper{
    public function index(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('home', $data);
    }

}