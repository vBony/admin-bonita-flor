<?php
namespace auth;

use models\Admin as ModelAdmin;
use models\AccessToken;
use models\validators\Admin as AdminValidator;
use core\controllerHelper;

class Admin{
    private $Admin;

    public function __construct(){
        $this->Admin = new ModelAdmin();
    }

    public function loginAfterRegister($id){
        $ModelAdmin = new ModelAdmin();

        $userData = $ModelAdmin->buscar($id);
        $this->setSession($userData);
    }

    public function login($data){
        $messages = array();
        $userFind = array();

        $AdminValidator = new AdminValidator();
        $AdminValidator->email($data);
        $AdminValidator->senha($data);

        if(empty($AdminValidator->getMessages())){
            $userFind = $this->Admin->buscarPorEmailNaoSeguro($data['email']);

            if(!empty($userFind)){
                if($this->validatePassword($data['senha'], $userFind['senha'])){
                    //Realizando a busca novamente para não salvar na sessão a senha
                    $userData =  $this->Admin->buscarPorEmail($data['email']);
                    
                    $this->setSession($userData);
                    
                    return true;
                }else{
                    $messages['senha'] = 'Senha inválida';
                }
            }else{
                $messages['email'] = 'Usuário não encontrado';
            }
        }else{
            $messages = $AdminValidator->getMessages();
        }

        return $messages;
    }

    public function logout(){
        $this->killSession();
    }

    public function validatePassword($password, $hash){
        return password_verify($password, $hash);
    }

    public function setSession($userData){
        $data = array();
        $data['accessToken'] = $this->setToken($userData);
        $data['user'] = $userData;

        $admin = new ModelAdmin();
        $admin->setTokenPorId($userData['id'], $data['accessToken']);

        $_SESSION['userSession'] = $data;
    }

    public function getIdUserLogged(){
        return $_SESSION['userSession']['user']['id'];
    }

    public function getIpUser(){
        return $_SERVER['REMOTE_ADDR'];
    }

    public function setTokenLifeTime(){
        return date('Y-m-d H:i:s', strtotime("+3 hours"));
    }

    public function setToken($userData){
        return md5($userData['id'] . rand(1,10000) . date('i:s') . rand(1,10000));
    }

    public function killSession(){
        $ModelToken = new AccessToken();
        $ipUser = $this->getIpUser();

        if(isset($_SESSION['userSession'])){
            $tokenFind = $ModelToken->buscarPorToken($_SESSION['userSession']['accessToken']['token']);

            if(!empty($tokenFind) && $ipUser == $tokenFind['ip']){
                $ModelToken->matarToken($tokenFind['id']);
                unset($_SESSION['userSession']);
            }
        }
    }

    public function isLogged(){
        if(!isset($_SESSION['userSession'])){
            $this->goToLogin();
        }else{
            $tokenSession = $_SESSION['userSession']['accessToken'];
            $idUser = $_SESSION['userSession']['user']['id'];

            if(!empty($tokenSession) && !empty($idUser)){
                if(!$this->validateToken($tokenSession, $idUser)){
                    $this->killSession();
                    $this->goToLogin();
                }
            }else{
                $this->goToLogin();
            }
        }
    }

    public function validateToken($token, $idUser){
        $ModelToken = new ModelAdmin();
        $tokenFind = $ModelToken->buscarPorToken($token);

        // Token existe?
        if(!empty($tokenFind)){
            // O usuário é dono desse token?
            if($tokenFind['id'] == $idUser){
                return true;
            }
            return false;
        }else{
            return false;
        }
    }

    public function goToLogin(){
        $ch = new controllerHelper;
        $loginUrl = $ch->baseUrl() . 'login';

        header("Location: $loginUrl");
    }
}