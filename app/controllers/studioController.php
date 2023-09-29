<?php
use core\controllerHelper;
class studioController extends controllerHelper{
    public function viewIndex(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('studio', $data);
    }
}