<?php
class notFoundController extends controllerHelper{
    public function index(){
        $this->loadView('not-found', array());
    }
}