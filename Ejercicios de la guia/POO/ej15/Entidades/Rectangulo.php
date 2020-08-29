<?php

//Hace falta incluir la clase acá? --NO!
//include_once "./FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica{
    
    //Atributos
    private $_ladoUno;
    private $_ladoDos;

    //Constructores
    public function __construct($l1, $l2) {
        parent::__construct();

        $this->_ladoUno = $l1;
        $this->_ladoDos = $l2;
        $this->CalcularDatos();
    }

    //Métodos

    //Implementación métodos abstractos
    public function Dibujar(){
        $aux = "";

        for ($i=0; $i < $this->_ladoUno; $i++) { 
            for ($j=0; $j < $this->_ladoDos; $j++) { 
                $aux .= "*";
            }
            $aux .= "<br>";
        }

        return $aux;
    }
    
    public function CalcularDatos(){
        $this->_perimetro = 2 * ($this->_ladoUno + $this->_ladoDos);//24;
        $this->_superficie = $this->_ladoUno * $this->_ladoDos;
    }

    public function ToString() {
        parent::ToString();

        echo "
        -Lado Uno: {$this->_ladoUno} <br>
        -Lado Dos: {$this->_ladoDos}
        <p style = 'color: {$this->_color}'>{$this->Dibujar()}</p>";
    }
    
}
