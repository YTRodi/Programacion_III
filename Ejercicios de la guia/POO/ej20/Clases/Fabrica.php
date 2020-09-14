<?php

class Fabrica {
    private $_cantMaxOperarios;
    private $_operarios;
    private $_razonSocial;

    public function __construct(string $rs = "") {
        $this->_razonSocial = $rs;
        $this->_cantMaxOperarios = 5;
        $this->_operarios = [];
    }

    private function RetornarCosto(){
        //Acumulador de salarios.
        $acumulador = 0;

        if(count($this->_operarios) === 0){
            return "</br>No hay operarios en la fábrica</br></br>";
        }else{
            foreach ($this->_operarios as $key => $value) {
                $acumulador += $value->GetSalario();
            }
        }

        return $acumulador;
    }

    private function MostrarOperarios(){
        $infoOp = "";

        foreach ($this->_operarios as $key => $value) {
            $infoOp += $value->Mostrar();  
        }

        return $infoOp;
    }

    public static function MostrarCosto(Fabrica $fb = null){
        if($fb !== null){
            return $fb->RetornarCosto(); //mmm
        }
    }

    public static function Equals(Fabrica $fb = null, Operario $op = null){

        if($fb !== null && $op !== null){
            foreach ($fb as $key => $value) {
                if($op->Equals($op,$key)){
                    return false;
                    break;
                }else{
                    return true;
                    break;
                }
            }
        }
    }

    public function Add(Operario $op = null){
        if($op !== null){
            if(count($this->_operarios) < $this->_cantMaxOperarios){
                array_push($this->_operarios,$op);
                return true;
            }else{
                return false;
            }
        }
    }
}