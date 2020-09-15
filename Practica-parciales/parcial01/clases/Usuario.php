<?php
include_once __DIR__.'/FileHandler.php';

class Usuario extends FileHandler{
    public $_email;
    public $_password;
    public static $pathUsuariosJSON = './archivos/users.json';

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
            echo parent::SaveJSON(Usuario::$pathUsuariosJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadUsuarioJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Usuario::$pathUsuariosJSON);
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
}