<?php
include_once __DIR__.'/FileHandler.php';

class Profesor extends FileHandler{ 
    public $_legajo;
    public $_nombre;
    public static $pathProfesoresJSON = './archivos/profesores.json';

    public function __construct($legajo,$nombre) {
        $this->_legajo = $legajo;
        $this->_nombre = $nombre;
    }

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
    public function __toString(){
        return $this->_legajo . '*' . $this->_nombre;
    }

    //----------------------------------------------------------------
    //----------------------------------------------------------------
    //JSON
    public static function SaveProfesorJSON(array $arrayObj = null){
        try {
            echo parent::SaveJSON(Profesor::$pathProfesoresJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadProfesorJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Profesor::$pathProfesoresJSON);
            $arrayProfesores = [];

            foreach ($listaFromArchivoJSON as $dato) {
                $nuevoProfesor = new Profesor($dato->_legajo,$dato->_nombre);
                array_push($arrayProfesores,$nuevoProfesor);
            }

        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        
        return $arrayProfesores;
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