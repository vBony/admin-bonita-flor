<?php
namespace models;

use core\controllerHelper;
use core\modelHelper;

use \PDO;
use \PDOException;

class Categoria extends modelHelper{

    public $table = 'categoria';
    public static $sufix = 'cat';

    public $colunas;
    public $attrs = [
        'id',
        'descricao',
        'excluido'
    ];

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
}