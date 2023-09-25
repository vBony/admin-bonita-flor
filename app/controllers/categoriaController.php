<?php
use core\controllerHelper;
use auth\Admin;
use core\modelHelper;
use models\Categoria;
use models\validators\Categoria as Validator;
class categoriaController extends controllerHelper{
    public function apiListar(){
        $admin = $this->isLogged();
        $model = new Categoria();
        $this->send(200, ['categorias'=>$model->buscar()]);
        
    }

    public function apiBuscar(){
        $admin = $this->isLogged();
        $model = new Categoria();

        $id = $this->post('id');

        $categoria = $model->buscar($id);

        if(!empty($categoria)){
            $this->send(200, ['categoria'=> $categoria]);
        }else{
            $this->send(404, ['categoria'=> $categoria]);
        }

        
    }

    public function viewCadastrar(){
        $admin = $this->isLogged();

        $data['component'] = $admin;

        $this->loadView('cadastro-categorias', $data);
    }

    public function apiCadastrar(){
        $admin = $this->isLogged();
        $data = $this->post();

        $validator = new Validator(modelHelper::$CRIANDO);
        
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

    public function apiAlterar(){
        $admin = $this->isLogged();
        $data = $this->post('categoria');

        $validator = new Validator(modelHelper::$ALTERANDO);
        
        $validator->validate($data);

        if(!empty($validator->getMessages())){
            $this->send(400, ['errors'=>$validator->getMessages()]);
        }else {
            $model = new Categoria();
            $sucesso = $model->alterar($data);
            if($sucesso == true ){
                $this->send(200, ["categoria"=>$model->buscar()]);
            }
        }
    }

    public function apiExcluir(){
        $admin = $this->isLogged();
        $id = $this->post('id');

        if(!empty($id)){
            $model = new Categoria();

            $categoria = $model->buscar($id);

            if(!empty($categoria)){
                $sucesso = $model->excluir($id);
            }
        }

        if($sucesso){
            $this->send(200);
        }else{
            $this->send(400);
        }
    }
}