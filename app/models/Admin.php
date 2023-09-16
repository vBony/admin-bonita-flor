<?php
namespace models;
use core\modelHelper;

use \PDO;
use \PDOException;

class Admin extends modelHelper{

    private $table = 'admin';

    public function __construct()
    {
        parent::__construct();
    }

    public function buscar($id = null){
        $sql  = "SELECT * FROM {$this->table} ";
        if(!empty($id)){
            $sql .= "WHERE id = :id";
        }
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            if(!empty($id)){
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
        }
    }

    public function buscarPorEmail($email){
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', strtolower($email));
        $sql->execute();

        if($sql->rowCount() > 0){
           return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function cadastrar($data){
        $sql = "INSERT INTO {$this->table}
        (nome, email, senha)
        VALUES(:nome, :email, :senha);";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', ucfirst(strtolower($data['nome'])));
        $sql->bindValue(':email', str_replace(' ', '', strtolower($data['email'])));
        $sql->bindValue(':senha', password_hash($data['senha'], PASSWORD_BCRYPT));

        try {
            $this->db->beginTransaction();
            $sql->execute();
            $id = $this->db->lastInsertId(PDO::FETCH_ASSOC);
            $this->db->commit();

            return $id;
        } catch(PDOException $e) {
            $this->db->rollback();
            return false;
        }
    }

    private function securityCodeGenerator(){
        $bytes = 4;
        $restult_bytes = random_bytes($bytes);
        $final_result = substr(bin2hex($restult_bytes),2);
        $codeFull = md5($final_result);
        $code = substr($codeFull, 26);
        return $code;
    }

    public function getAdminIp(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
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

    public function signin($email, $password){
        $sql = 'SELECT * FROM admins WHERE email = :email AND senha = :password';
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->execute();

        if($sql->rowCount() > 0){
            $admindata = $sql->fetchAll();
            return $admindata;
        }else{
            return false;
        }

    }
}