<?php
namespace models\validators;
use helpers\Validator;
use \DateTime;

class Sistema extends Validator {
    public $messages = [];

    private $emptyMessage = 'Campo obrigatório';

    public function getMessages(){
        return $this->messages;
    }

    public function getMessage($attr){
        if(isset($this->messages[$attr])){
            return $this->messages[$attr];
        }
    }

    public function validate($data){
        $this->endereco($data);
        $this->atendimento($data);
        $this->intervalo($data);
        // $this->diasAtendimento();
    }

    public function endereco($data){
        $endereco = $data['endereco'];

        $this->cep($endereco);
        $this->logradouro($endereco);
        $this->numero($endereco);
        $this->bairro($endereco);
        $this->cidade($endereco);
        $this->estado($endereco);
    }

    public function cep($data){
        $cep = isset($data['cep']) ? $data['cep'] : null;

        if(empty($cep)){
            $this->messages['endereco']['cep'] = $this->emptyMessage;
        }else{
            if(strlen($cep) != 8){
                $this->messages['endereco']['cep'] = "CEP Inválido";
            }
        }
    }

    public function logradouro($data){
        $logradouro = isset($data['logradouro']) ? $data['logradouro'] : null;

        if(empty($logradouro)){
            $this->messages['endereco']['logradouro'] = $this->emptyMessage;
        }
    }

    public function numero($data){
        $numero = isset($data['numero']) ? $data['numero'] : null;

        if(empty($numero)){
            $this->messages['endereco']['numero'] = $this->emptyMessage;
        }
    }

    public function bairro($data){
        $bairro = isset($data['bairro']) ? $data['bairro'] : null;

        if(empty($bairro)){
            $this->messages['endereco']['bairro'] = $this->emptyMessage;
        }
    }

    public function cidade($data){
        $cidade = isset($data['cidade']) ? $data['cidade'] : null;

        if(empty($cidade)){
            $this->messages['endereco']['cidade'] = $this->emptyMessage;
        }
    }

    public function estado($data){
        $estado = isset($data['estado']) ? $data['estado'] : null;

        if(empty($estado)){
            $this->messages['endereco']['estado'] = $this->emptyMessage;
        }
    }

    public function atendimento($data){
        $atendimento = $data['horarios']['atendimento'];

        $valida = $this->horarios($atendimento);
        if(!empty($valida)){
            $this->messages['horarios']['atendimento'] = $this->horarios($atendimento);
        }
    }

    public function intervalo($data){
        $intervalo = $data['horarios']['intervalo'];
        
        $valida = $this->horarios($intervalo);
        if(!empty($valida)){
            $this->messages['horarios']['intervalo'] = $this->horarios($intervalo);
        }
    }

    public function horarios($data){
        $inicio = $data['inicio'];
        $fim = $data['fim'];
        $errors = array();

        if(empty($inicio)){
            $errors['inicio'] = $this->emptyMessage;
        }

        if(empty($fim)){
            $errors['fim'] = $this->emptyMessage;
        }

        $validaInicio = $this->horasMinutos($inicio);
        if(!empty($validaInicio)){
            $errors['inicio'] = $validaInicio;
        }

        $validaFim = $this->horasMinutos($fim);
        if(!empty($validaFim)){
            $errors['fim'] = $validaFim;
        }

        if(empty($errors)){
            $mensagem = "Hora início não pode ser maior ou igual à data fim";
            $inicio =   DateTime::createFromFormat("H:i", $inicio);
            $fim    =   DateTime::createFromFormat("H:i", $fim);

            if($inicio >= $fim){
                $errors['inicio'] = $mensagem;
                $errors['fim'] = $mensagem;
            }
        }

        return $errors;
    }
}