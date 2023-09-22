<?php
namespace models;
use core\modelHelper;

use \PDO;
use \PDOException;

class AdminServico extends modelHelper{

    public $table = 'adminServico';
    public static $sufix = 'ads';

    public $colunas;
    public $attrs = [
        'id',
        'idServico',
        'idAdmin',
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

    public function buscarPorAdmin($idAdmin){
        $Servico = new Servico();
        $Categoria = new Categoria();

        $sufix = self::$sufix;
        $colunas = $this->colunas;

        $colunasServico = $Servico->colunas;
        $sufixServico = Servico::$sufix;

        $colunasCategoria = $Categoria->colunas;
        $sufixCategoria = Categoria::$sufix;

        $sql  = "SELECT 
                    {$colunas},
                    {$colunasServico},
                    {$colunasCategoria}
                FROM adminServico {$sufix}
                INNER JOIN servico {$sufixServico} on {$sufixServico}.id = {$sufix}.idServico
                    AND {$sufixServico}.excluido = 0
                INNER JOIN categoria {$sufixCategoria} ON {$sufixServico}.idCategoria = {$sufixCategoria}.id
                    AND {$sufixCategoria}.excluido = 0
                WHERE {$sufix}.idAdmin = :idAdmin
                AND {$sufix}.excluido = 0";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idAdmin', $idAdmin);
        $sql->execute();


        if($sql->rowCount() > 0){

            $data = $sql->fetchAll(PDO::FETCH_NAMED);

            //adicionar mapeamento
        }
    }

    public function salvar($data){
        $sql = "INSERT INTO {$this->table}
                    (idServico, idAdmin)
                VALUES
                    (:idServico, :idAdmin)";
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idServico', $data['idServico']);
        $sql->bindValue(':idAdmin', $data['idAdmin']);

        try {
            $this->db->beginTransaction();

            $sql->execute();
            $this->db->commit();

            return true;
        } catch(PDOException $e) {
            $this->db->rollback();

            exit($e->getMessage());
            // TODO: SALVAR ERRO NUMA TABELA DE LOG

            return false;
        }
    }
}