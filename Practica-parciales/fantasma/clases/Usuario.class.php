<?php
include_once __DIR__.'/FileHandler.class.php';

class Usuario extends FileHandler{
    public $_email;
    public $_password;
    public static $pathJSON = './archivos/Usuarios.json';

    public function __construct($email, $password) {
        $this->_email = $email;
        $this->_password = $password;
    }

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
    public function __toString(){
        return $this->_email . '*' . $this->_password;
    }

    //----------------------------------------------------------------
    //----------------------------------------------------------------
    //JSON
    public static function SaveUsuarioJSON(array $arrayObj = null){
        try {
            echo parent::SaveJSON(Usuario::$pathJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadUsuarioJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Usuario::$pathJSON);
            $arrayUsuario = [];

            foreach ($listaFromArchivoJSON as $dato) {
                $nuevoUsuario = new Usuario($dato->_email,$dato->_password);
                array_push($arrayUsuario,$nuevoUsuario);
            }

        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        
        return $arrayUsuario;
    }

    public function verificarUsuario(array $array = null){
        $loginUser = false;

        if($array !== null){
            foreach ($array as $user ) {

                if($user->_password === $this->_password && $user->_email === $this->_email){
                    $loginUser = true;
                }
            }
        }else{
            throw new Exception('<br/>Array null.<br/>');
        }
        return $loginUser;
    }

    /**
     * POR SI LAS MOSCAS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
     */
    public static function autoID(array $array = null){
        if($array !== null){
            $id = 0;
            foreach ($array as $item) {
                if($item->_id > $id){
                    $id = $item->_id;
                }
            }
        }
        return $id + 1;
    }

    public function LegajoUnico(array $array = null){
        if($array !== null){
            $legajoRepetido = false;
            foreach ($array as $item) {
                if($item->_legajo === $this->_legajo){
                    $legajoRepetido = true;
                }
            }
        }
        return $legajoRepetido;
    }
}