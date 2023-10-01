<?php
namespace helpers;

class Validator {
    public function horasMinutos($str){
        $duracaoArr = explode(":", $str);
        $mensagem =  "Siga o seguinte padrão HH:MM";

        if(count($duracaoArr) == 2){
            if(strlen($duracaoArr[0]) < 2 || strlen($duracaoArr[1]) < 2){
                return $mensagem;
            }else{
                if($duracaoArr[1] > 59){
                    return $mensagem;
                }
            }
        }else{
            return $mensagem;
        }
    }
}