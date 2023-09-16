<?php
namespace models\validators;
use models\Admin as modelAdmin;

class Admin  {
    public $messages = [];
    private $emptyMessage = 'Campo obrigatório';
    private $type;
    
    public static $CRIANDO = 'create';

    public function __construct($type = null)
    {
        $this->type = $type;
    }


    public function validate($data){
        $this->nome($data);
        $this->email($data);

        if($this->type == self::$CRIANDO){
            $this->senhaAoCriar($data);
        }
    }

    public function getMessages(){
        return $this->messages;
    }

    public function getMessage($attr){
        if(isset($this->messages[$attr])){
            return $this->messages[$attr];
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
            }elseif($this->type == 'create'){
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
            if(strlen($pass) < 5 && $this->type == 'create'){
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