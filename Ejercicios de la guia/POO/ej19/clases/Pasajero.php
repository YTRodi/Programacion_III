<?php

class Pasajero {
    private $_apellido;
    private $_nombre;
    private $_dni;
    private $_esPlus;
    
    public function __construct(string $apellido = "", string $nombre = "", string $dni = "", bool $esPlus = false) {
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_dni = $dni;
        $this->_esPlus = $esPlus;
    }

    public function Equals(Pasajero $p1 = null, Pasajero $p2 = null){
        $sonIguales = false;

        if($p1 !== null && $p2 !== null){
            if($p1->_dni === $p2->_dni){
                $sonIguales = true;        
            }
        }else{
            echo "Un pasajero es null.";
            $sonIguales = false;
        }

        return $sonIguales;
    }

    public function GetInfoPasajero(){
        $info = "";

        $info .= "INFO DEL PASAJERO:</br>";
        $info .= "Apellido: {$this->_apellido}</br>";
        $info .= "Nombre: {$this->_nombre}</br>";
        $info .= "Dni: {$this->_dni}</br>";

        if($this->_esPlus){
            $info .= "Es plus: TRUE</br></br>";
        }else{
            $info .= "Es plus: FALSE</br></br>";
        }

        return $info;
    }

    public static function MostrarPasajero(Pasajero $p){
        echo $p->GetInfoPasajero();
    }

    public function GetEsPlus(){
        return $this->_esPlus;
    }

    
}