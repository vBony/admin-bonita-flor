<?php
use core\controllerHelper;
use models\Sistema as Model;
class studioController extends controllerHelper{
    public function viewIndex(){
        $admin = $this->isLogged();
        $data['component'] = $admin;

        $this->loadView('studio', $data);
    }
}