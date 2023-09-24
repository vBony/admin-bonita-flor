<?php
namespace models\validators;


class Categoria  {
    public $messages = [];
    private $emptyMessage = 'Campo obrigatório';

    public function validate($data){
        $this->descricao($data);
    }

    public function getMessages(){
        return $this->messages;
    }

    public function getMessage($attr){
        if(isset($this->messages[$attr])){
            return $this->messages[$attr];
        }
    }

    public function descricao($data){
        $descricao = isset($data['descricao']) ? $data['descricao'] : null;
        if(empty($descricao)){
            $this->messages['descricao'] = $this->emptyMessage;
        }
    }
}  