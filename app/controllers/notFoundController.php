
<?php
use  core\controllerHelper;

class notFoundController extends controllerHelper{
    public function index(){
        $this->loadView('not-found', array());
    }
}