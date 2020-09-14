<?php
include_once __DIR__.'/FileHandler.php';

class Auto extends fileHandler {
    private $_id;
    private $_marca;
    private $_modelo;
    private $_color;
    private $_precio;

    public function __construct(int $id, string $marca = "",string $modelo = "", string $color = "", float $precio = 0) {
        $this->_id = $id;
        $this->_marca = $marca;
        $this->_modelo = $modelo;
        $this->_color = $color;
        $this->_precio = $precio;
    }

    public function __get($name){ $this->$name; }
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
}

