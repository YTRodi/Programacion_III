<?php

class Triangulo extends FiguraGeometrica{
    
    //Atributos
    private $_altura;
    private $_base;

    //Constructores
    public function __construct($b, $h) {
        parent::__construct();

        $this->_base = $b;
        $this->_altura = $h;
        $this->CalcularDatos();
    }

    //Métodos

    //Implementación métodos abstractos
    public function Dibujar(){
        $aux = "";
        //Uso la base.
        
        for ($lineaActual=1; $lineaActual <= $this->_base; $lineaActual++) { 
            
            for ($espacio=0; $espacio < $this->_base - $lineaActual; $espacio++) { 
                $aux .= "&nbsp"; //Agrego un espacio en blanco HTML
                $aux .= "&nbsp";
            }

            for ($asterisco=0; $asterisco < ($lineaActual * 2) - 1; $asterisco++) { 
                $aux .= "*";
            }
            $aux .= "<br>";

        }

        return $aux;
    }
    
    public function CalcularDatos(){
        $this->_perimetro = $this->_base + ($this->_altura * 2);
        $this->_superficie = $this->_base * ($this->_altura / 2); //base por media de altura.
    }

    public function ToString() {
        parent::ToString();
        
        echo "
        -Base: {$this->_base} <br>
        -Altura: {$this->_altura}
        <p style = 'color: {$this->_color}; background-color: gray;'>{$this->Dibujar()}</p>";
    }
    
}
