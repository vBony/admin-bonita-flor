<?php
namespace models;
use config\entidades\DiasAtendimento;
use config\entidades\Endereco;
use config\entidades\Horas;
use core\modelHelper;

class Sistema extends modelHelper {
    private $endereco;
    private $horasAtendimento;
    private $horasIntervalo;
    private $diasAtendimento;

    private $diretorioJson;

    public function __construct(){
        $this->endereco = new Endereco();
        $this->horasAtendimento = new Horas();
        $this->horasIntervalo = new Horas();
        $this->diasAtendimento = new DiasAtendimento();
        $this->diretorioJson = $this->diretorioBase() . 'app/config/config.json';
        
        if(!file_exists($this->diretorioJson)){
            $this->criarConfiguracaoPadrao();
        }else{
            $this->construirConfig();
        }
    }

    public function get(){
        $data = array();
        $data['endereco'] = (array) $this->endereco;
        $data['horarios']['atendimento'] = (array) $this->horasAtendimento;
        $data['horarios']['intervalo'] = (array) $this->horasIntervalo;
        $data['diasAtendimento'] = (array) $this->diasAtendimento;

        return $data;
    }

    public function salvarConfig(){
        $json = array();
        $json['endereco'] = $this->endereco;
        $json['horarios']['atendimento'] = $this->horasAtendimento;
        $json['horarios']['intervalo'] = $this->horasIntervalo;
        $json['diasAtendimento'] = $this->diasAtendimento;

        $json = json_encode($json);

        if (file_put_contents($this->diretorioJson, $json)) {
            return true;
        } else {
            return false;
        }
    }

    public function construirConfig(){
        $json = file_get_contents($this->diretorioJson);

        $data = json_decode($json, true);

        $this->setEndereco($data);
        $this->setDiasAtendimento($data['diasAtendimento']);
        $this->setHorasAtendimento($data['horarios']['atendimento']);
        $this->setHorasIntervalo($data['horarios']['intervalo']);
    }

    public function setEndereco(array $data){
        $cep = isset($data['cep']) ? $data['cep'] : ''; 
        $logradouro = isset($data['logradouro']) ? $data['cep'] : ''; 
        $numero = isset($data['numero']) ? $data['cep'] : ''; 
        $complemento = isset($data['complemento']) ? $data['cep'] : ''; 
        $bairro = isset($data['bairro']) ? $data['cep'] : ''; 
        $cidade = isset($data['cidade']) ? $data['cep'] : ''; 
        $estado = isset($data['estado']) ? $data['cep'] : ''; 

        $this->endereco->cep = $cep;
        $this->endereco->logradouro = $logradouro;
        $this->endereco->numero = $numero;
        $this->endereco->complemento = $complemento;
        $this->endereco->bairro = $bairro;
        $this->endereco->cidade = $cidade;
        $this->endereco->estado = $estado;
    }

    public function setHorasAtendimento(array $data){
        $inicio = isset($data['inicio']) ? $data['inicio'] : ''; 
        $fim = isset($data['fim']) ? $data['fim'] : ''; 

        $this->horasAtendimento->inicio = $inicio;
        $this->horasAtendimento->fim = $fim;
    }

    public function setHorasIntervalo(array $data){
        $inicio = isset($data['inicio']) ? $data['inicio'] : ''; 
        $fim = isset($data['fim']) ? $data['fim'] : ''; 

        $this->horasIntervalo->inicio = $inicio;
        $this->horasIntervalo->fim = $fim;
    }

    public function setDiasAtendimento(array $data){
        $segunda = isset($data['segunda']) ? $data['segunda'] : false;
        $terca = isset($data['terca']) ? $data['terca'] : false;
        $quarta = isset($data['quarta']) ? $data['quarta'] : false;
        $quinta = isset($data['quinta']) ? $data['quinta'] : false;
        $sexta = isset($data['sexta']) ? $data['sexta'] : false;
        $sabado = isset($data['sabado']) ? $data['sabado'] : false;
        $domingo = isset($data['domingo']) ? $data['domingo'] : false;

        $this->diasAtendimento->segunda = $segunda;
        $this->diasAtendimento->terca = $terca;
        $this->diasAtendimento->quarta = $quarta;
        $this->diasAtendimento->quinta = $quinta;
        $this->diasAtendimento->sexta = $sexta;
        $this->diasAtendimento->sabado = $sabado;
        $this->diasAtendimento->domingo = $domingo;
    }

    private function criarConfiguracaoPadrao(){
        $this->setConfigPadrao();
        $this->salvarConfig();
    }

    private function setConfigPadrao(){
        $this->setHorasAtendimentoPadrao();
        $this->setHorasIntervaloPadrao();
        $this->setDiasAtendimentoPadrao();
        $this->setEnderecoPadrao();
    }
    private function setHorasAtendimentoPadrao(){
        $this->horasAtendimento->inicio = "08:00";
        $this->horasAtendimento->fim = "18:00";
    }

    private function setHorasIntervaloPadrao(){
        $this->horasIntervalo->inicio = "08:00";
        $this->horasIntervalo->fim = "18:00";
    }

    private function setDiasAtendimentoPadrao(){
        $this->diasAtendimento->segunda = true;
        $this->diasAtendimento->terca = true;
        $this->diasAtendimento->quarta = true;
        $this->diasAtendimento->quinta = true;
        $this->diasAtendimento->sexta = true;
        $this->diasAtendimento->sabado = false;
        $this->diasAtendimento->domingo = false;
    }

    private function setEnderecoPadrao(){
        $this->endereco->cep = '';
        $this->endereco->logradouro = '';
        $this->endereco->numero = '';
        $this->endereco->complemento = '';
        $this->endereco->bairro = '';
        $this->endereco->cidade = '';
        $this->endereco->estado = '';
    }
}