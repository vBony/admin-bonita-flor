<?php
namespace models\validators;
use models\AdminServico as Model;
use models\Servico;

class AdminServico  {
    public $messages = [];
    private $emptyMessage = 'Campo obrigatório';

    public function validate($data){
        $this->idServico($data);
    }

    public function getMessages(){
        return $this->messages;
    }

    public function getMessage($attr){
        if(isset($this->messages[$attr])){
            return $this->messages[$attr];
        }
    }

    public function idServico($data){
        $model = new Model();
        $Servico = new Servico();

        $idServico = isset($data['idServico']) ? $data['idServico'] : null;
        $idAdmin =  isset($data['idAdmin']) ? $data['idAdmin'] : null;

        if(empty($idServico)){
            $this->messages['servico'] = 'Serviço é obrigatório';
        }

        $servico = $Servico->buscar($idServico);

        if(empty($servico)){
            $this->messages['servico'] = 'Serviço não encontrado';
        }

        if(empty($idAdmin)){
            $this->messages['admin'] = 'Admin é obrigatório';
        }

        if(empty($this->messages)){
            if(!empty($model->buscarPorServicoEAdmin($idServico, $idAdmin))){
                $this->messages['servico'] = 'Serviço já adicionado';
            }
        }
    }

    // nome	lastName	email	urlAvatar	senha	
    public function nome($data){
        $nome = $data['nome'];

        if(!empty($nome)){
            if(strlen($nome) <= 2 || count(explode(' ', $nome)) <= 1)
                $this->messages['nome'] = 'Digite seu nome completo';
        }else{
            $this->messages['nome'] = $this->emptyMessage;
        }
    }

    public function email($data){
        $email = $data['email'];
        $Admin = new modelAdmin();

        if(empty($email)){
            $this->messages['email'] = $this->emptyMessage;
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->messages['email'] = "Email inválido"; 
            }elseif($this->type == self::$CRIANDO){
                $userFind = $Admin->buscarPorEmail($data['email']);

                if(!empty($userFind)){
                    $this->messages['email'] = "E-mail já está em uso";
                }
            }
        }
    }

    public function senha($data){
        $pass = $data['senha'];

        if(!empty($pass)){
            if(strlen($pass) < 5 && $this->type == self::$CRIANDO){
                $this->messages['senha'] = 'A senha deve conter no mínimo 5 caracteres';
            }
        }else{
            $this->messages['senha'] = $this->emptyMessage;
        }
    }

    public function retypePassword($data){
        $pass = $data['senha'];
        $rpass = $data['retypePassword'];

        if(!empty($rpass)){
            if($pass != $rpass){
                $this->messages['senha'] = 'As senhas não conferem';
                $this->messages['retypePassword'] = 'As senhas não conferem';
            }
        }else{
            $this->messages['retypePassword'] = $this->emptyMessage;
        }
    }

    public function senhaAoCriar($data){
        $this->senha($data);
        // $this->retypePassword($data);
    }
}

// 53151453
// Quadra 48, Conjunto F, Casa 29 - Vila São José (Brazlândia - DF)