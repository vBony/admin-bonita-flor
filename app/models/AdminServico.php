<?php
namespace models;
use core\modelHelper;

use \PDO;
use \PDOException;

class AdminServico extends modelHelper{

    private $table = 'adminServico';

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

    public function buscarPorServicoEAdmin($idServico, $idAdmin){
        $sql  = "SELECT 
                    tb.*
                FROM adminServico tb
                INNER JOIN servico s on s.id = tb.idServico
                    AND s.excluido = 0
                INNER JOIN categoria c ON s.idCategoria = c.id
                    AND c.excluido = 0
                WHERE tb.idAdmin = :idAdmin
                AND tb.idServico = :idServico
                AND tb.excluido = 0";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idServico', $idServico);
        $sql->bindValue(':idAdmin', $idAdmin);


        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function salvar($data){

    }

    public function validar($data){

    }
}