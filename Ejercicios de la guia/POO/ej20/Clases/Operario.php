b<?php

class Operario{
    private $_apellido;
    private $_nombre;
    private $_legajo;
    private $_salario;

    public function __construct(int $legajo = 0, string $apellido = "", string $nombre = "") {
        $this->_legajo = $legajo;
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_salario = 0;
    }

    //Getters
    public function GetSalario() {
        return $this->_salario;
    }

    public function getNombreApellido(){
        return "{$this->_nombre}, {$this->_apellido}<br>";
    }

    //Setters
    public function SetAumentarSalario(float $aumento) {
        $this->_salario += ($this->_salario * ($aumento/100));
    }

    public function Mostrar(){
        $infoOperario = "";
        
        $infoOperario .= "Legajo: {$this->_legajo}</br>";
        $infoOperario .= "Nombre y apellido: " . $this->getNombreApellido();
        $infoOperario .= "Salario: $ {$this->_salario}";

        return $infoOperario;
    }

    public static function MostrarOp(Operario $op = null){
        return $op->Mostrar();
    }

    public function Equals(Operario $op1, Operario $op2){
        if($op1->_nombre === $op2->_nombre && $op1->_apellido === $op2->_apellido && $op1->_legajo === $op2->_legajo){
            return "True";
        }else{
            return "False";
        }
    }
}