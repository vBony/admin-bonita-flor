<?php
use core\controllerHelper;
use models\SistemaEndereco;
use models\Sistema as Model;
use models\SistemaDiasAtendimento;
use models\SistemaHorarios;
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

        $this->send(200, $model->buscar());
    }

    public function apiAlterar(){
        $admin = $this->isLogged();

        $mEndereco = new SistemaEndereco();
        $mHorarios = new SistemaHorarios();
        $mDiasAtendimento = new SistemaDiasAtendimento();


        $validator = new Validator();

        $data = $this->post();
        $validator->validate($data);

        $endereco = $data['endereco'];
        $horarios = $data['horarios'];
        $diasAtendimento = $data['diasAtendimento'];


        if(!empty($validator->getMessages())){
            $this->send(400, ['errors' => $validator->getMessages()]);
        }else{
            $sucesso = $mEndereco->salvar($endereco);
            $sucesso = $sucesso && $mHorarios->salvar($horarios);
            $sucesso = $sucesso && $mDiasAtendimento->salvar($diasAtendimento);

            if($sucesso){
                $this->send(200);
            }else{
                $this->send(500);
            }
        }


    }
}