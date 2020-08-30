<?php
//Tengo que incluir Auto.php? no?
//include "./Auto.php";

class Garage {
    //Atributos
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;
    
    //Constructores
    public function __construct(string $rs = "", float $ph = 0) {
        $this->_razonSocial = $rs;
        $this->_precioPorHora = $ph;
        $this->_autos = [];
    }

    //Métodos
    public function MostrarGarage(){
        $infoGarage = "";
        $i = 0;

        $infoGarage .= "Razón social: {$this->_razonSocial}</br>";
        $infoGarage .= "Precio por hora: $ {$this->_precioPorHora}</br>";

        $infoGarage .= "Datos autos en garage:</br>";

        foreach ($this->_autos as $key) {
            $infoGarage .= "</br>Auto nº {$i}:";
            $infoGarage .= $key->MostrarAuto($key);
            $i++;
        }

        $infoGarage .= "</hr>";

        return $infoGarage;
    }

    public function Equals(Garage $garage, Auto $auto){
        if(in_array($auto,$garage->_autos)){
            return "True"; //true;
        }else{
            return "False"; //false;
        }
    }

    public function Add(Auto $auto){
        $infoAdd = "";

        if($auto !== null){
            if(!in_array($auto,$this->_autos)){
                array_push($this->_autos,$auto);
                $infoAdd .= "Auto agregado con éxito! </br></br>";

            }else{
                $infoAdd .= "El auto ya se encuentra en el garage.</br></br>";                
            }

        }else{
            $infoAdd .= "El auto es null. </br>";
        }

        return $infoAdd;
    }

    public function Remove(Auto $auto){
        $infoRemove = "";

        if($auto !== null){
            if(in_array($auto,$this->_autos)){
                foreach ($this->_autos as $key => $value) {
                    if($this->_autos[$key] === $auto){
                        unset($this->_autos[$key]);
                        $infoRemove .= "</br>Auto eliminado con éxito! </br></br>";
                        break;
                    }
                }

            }else{
                $infoRemove .= "El auto no está en el garage.</br></br>";
            }

        }else{
            $infoRemove .= "El auto es null. </br></br>";
        }
        
        return $infoRemove;
    }
}