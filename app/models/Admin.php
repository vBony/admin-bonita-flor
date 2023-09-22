<?php
namespace models;

use core\controllerHelper;
use core\modelHelper;

use \PDO;
use \PDOException;

class Admin extends modelHelper{

    public $table = 'admin';

    public function __construct()
    {
        parent::__construct();
    }

    private $UM_REGISTRO = 'one';
    private $MULTIPLOS_REGISTROS = 'all';
    public static $FOTO_PERFIL_PADRAO = 'default.png';
    public static $CAMINHO_FOTO_PADRAO = 'app/assets/profile_pics/';

    private $camposSeguros = "
        id, 
        nome, 
        foto, 
        descricao, 
        telefone, 
        email, 
        dataCriacao, 
        excluido, 
        ultimoAcesso
    ";

    private $campos = "
        id, 
        nome, 
        foto, 
        descricao, 
        telefone, 
        email, 
        dataCriacao, 
        excluido, 
        ultimoAcesso,
        senha
    ";

    public function buscar($id = null){
        $sql  = "SELECT 
                    {$this->camposSeguros}
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
                $data = $this->complementarRegistros($sql->fetch(PDO::FETCH_ASSOC), $this->UM_REGISTRO);
                return $data;
            }else{
                $data = $this->complementarRegistros($sql->fetchAll(PDO::FETCH_ASSOC), $this->MULTIPLOS_REGISTROS);
                return $data;
            }
        }
    }

    public function buscarPorEmail($email){
        $sql = "SELECT {$this->camposSeguros} FROM {$this->table} WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', strtolower($email));
        $sql->execute();

        if($sql->rowCount() > 0){
           return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function buscarPorEmailNaoSeguro($email){
        $sql = "SELECT {$this->campos} FROM {$this->table} WHERE email = :email";
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
        $sql->bindValue(':nome', ucwords(strtolower($data['nome'])));
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

    private function complementarRegistros($data, $tipoData){
        if($tipoData == $this->UM_REGISTRO){
            $data['foto'] = $this->validaAvatar($data['foto']);
        }else{
            foreach($data as $i => $registro){
                $data[$i]['foto'] = $this->validaAvatar($registro['foto']);
            }
        }

        return $data;
    }

    public function validaAvatar($nomeArquivo){
        $ch = new controllerHelper;
        $bUrl = $ch->baseUrl();

        $caminho = self::$CAMINHO_FOTO_PADRAO.$nomeArquivo;

        if(!file_exists($caminho) || empty($nomeArquivo)){
            return $bUrl.self::$CAMINHO_FOTO_PADRAO.self::$FOTO_PERFIL_PADRAO;
        }else{
            return $bUrl.$caminho;
        }
    }

    public function setTokenPorId($id, $token){
        $sql = "UPDATE admin SET token = :token WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->bindValue(':id', $id);
        $sql->execute();

        return true;
    }

    public function buscarPorToken($token){
        $sql = "SELECT {$this->camposSeguros} FROM admin WHERE token = :token";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->execute();

        if($sql->rowCount() > 0){
            return $sql->fetch(PDO::FETCH_ASSOC);
         }
    }

}