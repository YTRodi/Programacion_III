<?php
include_once __DIR__.'/FileHandler.php';

class Materia extends FileHandler{ 
    public $_id;
    public $_nombre;
    public $_cuatrimestre;
    public static $pathMateriasJSON = './archivos/materias.json';

    public function __construct($id,$nombre,$cuatrimestre) {
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_cuatrimestre = $cuatrimestre;
    }

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
    public function __toString(){
        return $this->_id . '*' . $this->_nombre . '*' . $this->_cuatrimestre;
    }

    //----------------------------------------------------------------
    //----------------------------------------------------------------
    //JSON
    public static function SaveMateriaJSON(array $arrayObj = null){
        try {
            echo parent::SaveJSON(Materia::$pathMateriasJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadMateriaJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Materia::$pathMateriasJSON);
            $arrayMaterias = [];

            foreach ($listaFromArchivoJSON as $dato) {
                $nuevaMateria = new Materia($dato->_id,$dato->_nombre,$dato->_cuatrimestre);
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