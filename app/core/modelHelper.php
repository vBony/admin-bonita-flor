<?php
namespace core;
use core\Database;
class modelHelper{
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }   

    public static function createdAt(){
        return date('Y-m-d H:i:s');
    }

    public static function getIpAddress(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function setColunas($sufixo, $atributos){
        $retorno = array();
        foreach($atributos as $atributo){
            $str = "$sufixo.$atributo"." as ".$sufixo."_".$atributo;
            array_push($retorno, $str);
        }

        return implode(",", $retorno);
    }

    public function mapear($dados){

    }

    public function mapearAgregado($chave, $dados){

    }

    public function mapearLista($dados){

    }

    public function mapearListaAgregado($chave, $dados){

    }
}
?>