<?php
namespace models;
use core\modelHelper;

use \PDO;
use \PDOException;

class Servico extends modelHelper{

    public $table = 'servico';
    public static $sufix = 'svc';

    public $attrs = [
        'id',
        'idCategoria',
        'descricao',
        'nome',
        'preco',
        'duracao',
        'excluido'
    ];

    public $colunas;

    public function __construct()
    {
        $this->colunas = $this->setColunas(self::$sufix, $this->attrs);
        parent::__construct();
    }

    public function buscar($id = null){
        $sql  = "SELECT 
                    *
                FROM {$this->table} 
                WHERE excluido = 0 ";
        
        if(!empty($id)){
            $sql .= "AND id = :id";
        }

        $sql = $this->db->prepare($sql);

        if(!empty($id)){
            $sql->bindValue(':id', $id);
        }

        $sql->execute();

        if($sql->rowCount() > 0){
            if(!empty($id)){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                return $data;
            }else{
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
        }
    }

    public function buscarPorCategoria($idCategoria){
        $sql  = "SELECT * FROM {$this->table} 
                WHERE idCategoria = :id
                AND excluido = 0";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $idCategoria);

        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
}