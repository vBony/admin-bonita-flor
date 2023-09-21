<?php
namespace models;

use core\controllerHelper;
use core\modelHelper;

use \PDO;
use \PDOException;

class Categoria extends modelHelper{

    private $table = 'categoria';

    public function __construct()
    {
        parent::__construct();
    }

    public function buscar($id = null){
        $sql  = "SELECT 
                    *
                FROM {$this->table} ";
        
        if(!empty($id)){
            $sql .= "WHERE id = :id";
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