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
    public static function SaveMateriaJSON(array $arrayObj = null){
        try {
            echo parent::SaveJSON(Profesor::$pathProfesoresJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadMateriaJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Profesor::$pathProfesoresJSON);
            $arrayMaterias = [];

            foreach ($listaFromArchivoJSON as $dato) {
                $nuevaMateria = new Profesor($dato->_id,$dato->_nombre,$dato->_cuatrimestre);
                array_push($arrayMaterias,$nuevaMateria);
            }

        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        
        return $arrayMaterias;
    }

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
}