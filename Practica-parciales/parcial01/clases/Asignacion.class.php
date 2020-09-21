<?php
include_once __DIR__.'/FileHandler.php';

class Asignacion extends FileHandler{ 
    public $_idAsignacion;
    public $_legajoProfesor;
    public $_idMateria;
    public $_turno;
    public static $pathAsignacionJSON = './archivos/materias-profesores.json';

    public function __construct($idAsignacion,$legajoProfesor,$_dMateria,$turno) {
        $this->_idAsignacion = $idAsignacion;
        $this->_legajoProfesor = $legajoProfesor;
        $this->_idMateria = $_dMateria;
        $this->_turno = $turno;
    }

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
    public function __toString(){
        return $this->_idAsignacion . '*' .$this->_legajoProfesor . '*' . $this->_idMateria . '*' . $this->_turno;
    }

    //----------------------------------------------------------------
    //----------------------------------------------------------------
    //JSON
    public static function SaveAsignacionJSON(array $arrayObj = null){
        try {
            echo parent::SaveJSON(Asignacion::$pathAsignacionJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadAsignacionJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Asignacion::$pathAsignacionJSON);
            $arrayAsignacion = [];

            foreach ($listaFromArchivoJSON as $dato) {
                $nuevaAsignacion = new Asignacion($dato->_idAsignacion,$dato->_legajoProfesor,$dato->_idMateria,$dato->_turno);
                array_push($arrayAsignacion,$nuevaAsignacion);
            }

        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        
        return $arrayAsignacion;
    }

    public static function autoID(array $array = null){
        if($array !== null){
            $id = 0;
            foreach ($array as $item) {
                if($item->_idAsignacion > $id){
                    $id = $item->_idAsignacion;
                }
            }
        }
        return $id + 1;
    }
}