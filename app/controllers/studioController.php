<?php
use core\controllerHelper;
use models\Sistema as Model;
class studioController extends controllerHelper{
    public function viewIndex(){
        $admin = $this->isLogged();

        $model = new Model();
        echo '<pre>'; 
        print_r($model->get());
        echo '<br> '.__CLASS__.'| Linha: '.__LINE__. '<br>';
        echo '<pre>'; 
        exit;

        $data['component'] = $admin;

        $this->loadView('studio', $data);
    }
}