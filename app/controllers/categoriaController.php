<?php
use core\controllerHelper;
use auth\Admin;
use models\Categoria;
use models\validators\Categoria as Validator;
class categoriaController extends controllerHelper{
    public function apiBuscar(){
        $admin = $this->isLogged();
        $model = new Categoria();
        $this->send(200, ['categorias'=>$model->buscar()]);
        
    }

    public function viewCadastrar(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('cadastro-categorias', $data);
    }

    public function apiCadastrar(){
        $admin = $this->isLogged();
        $data = $this->post();

        $validator = new Validator();
        
        $validator->validate($data);

        if(!empty($validator->getMessages())){
            $this->send(400, ['errors'=>$validator->getMessages()]);
        }else {
            $model = new Categoria();
            $sucesso = $model->salvar($data);
            if($sucesso == true ){
                $this->send(200, ["categorias"=>$model->buscar()]);
            }
        }
    }
}