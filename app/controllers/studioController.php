<?php
use core\controllerHelper;
use models\Sistema as Model;
use models\validators\Sistema as Validator;
class studioController extends controllerHelper{
    public function viewIndex(){
        $admin = $this->isLogged();
        $data['component'] = $admin;

        $this->loadView('studio', $data);
    }

    public function apiIndex(){
        $admin = $this->isLogged();
        $model = new Model();

        $this->send(200, $model->get());
    }

    public function apiAlterar(){
        $admin = $this->isLogged();
        $model = new Model();
        $validator = new Validator();

        $data = $this->post();
        $validator->validate($data);

        if(!empty($validator->getMessages())){
            $this->send(400, ['errors' => $validator->getMessages()]);
        }else{
            $model->set($data);
            $this->send(200);
        }


    }
}