<?php
include_once __DIR__.'/FileHandler.php';

class Auto extends fileHandler {
    public $_id;
    public $_marca;
    public $_modelo;
    public $_color;
    public $_precio;
    //Agregar fecha?
    public static $pathAutos = './archivos/autos.txt';
    public static $pathAutosJSON = './archivos/autos.json';
    public static $pathAutosSer = './archivos/autos.ser';

    public function __construct(int $id, string $marca = "",string $modelo = "", string $color = "", float $precio = 0) {
        $this->_id = $id;
        $this->_marca = $marca;
        $this->_modelo = $modelo;
        $this->_color = $color;
        $this->_precio = $precio;
    }

    public function __get($name){ return $this->$name; }
    public function __set($name, $value){ $this->$name = $value; }
    public function getID(){
        return $this->_id;
    }
    public static function MostrarAuto(Auto $auto = null){
        $strBuilder = "";

        if($auto !== null){
            $strBuilder .= $auto->_marca . " " . $auto->_modelo . " " . $auto->_color . " " . $auto->_precio;
        }else{
            $strBuilder -= "<br>El auto no puede ser null<br>";
        }

        return $strBuilder;
    }

    public function __toString(){
        return $this->_id . "*" . $this->_marca . "*" . $this->_modelo . "*" . $this->_color . "*" . $this->_precio;
    }

    //---------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------

    //Funciones archivos

    //Línea a línea
    public function SaveAuto(){
        try {
            echo parent::SaveLineToLine(Auto::$pathAutos,$this);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    //Necesito una instancia de Auto para poder usar está función. (Poco reutilizable)
    public function ReadAuto(){
        try {
            echo parent::ReadLineToLine(Auto::$pathAutos);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ArrayOfAutos(){
        try {
            //Pasamanos...
            $listaFromArchivo = parent::BringArray(Auto::$pathAutos);
            $arrayAutos = [];
            /**
             * INDICE 0 = id
             * INDICE 1 = marca
             * INDICE 2 = modelo
             * INDICE 3 = color
             * INDICE 4 = precio
             */

            foreach ($listaFromArchivo as $dato) {
                $nuevoAuto = new Auto ($dato[0],$dato[1],$dato[2],$dato[3],$dato[4]);
                array_push($arrayAutos,$nuevoAuto);
            }

        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        
        return $arrayAutos;
    }
    
    //JSON
    public static function SaveAutoJSON(array $arrayObj = null){
        try {
            echo parent::SaveJSON(Auto::$pathAutosJSON,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadAutoJSON(){
        try {
            //Pasamanos...
            $listaFromArchivoJSON = parent::ReadJSON(Auto::$pathAutosJSON);
            $arrayAutos = [];

            foreach ($listaFromArchivoJSON as $dato) {
                $nuevoAuto = new Auto($dato->_id,$dato->_marca,$dato->_modelo,$dato->_color,$dato->_precio);
                array_push($arrayAutos,$nuevoAuto);
            }

        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
        
        return $arrayAutos;
    }

    //Serializar
    public static function SaveAutoSerialize(array $arrayObj){
        try {
            echo parent::SaveSerialize(Auto::$pathAutosSer,$arrayObj);
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function ReadAutoSerialize(){
        try {
            $listaFromArchivoSer = parent::ReadSerialize(Auto::$pathAutosSer);

            return $listaFromArchivoSer;
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }
    }
}