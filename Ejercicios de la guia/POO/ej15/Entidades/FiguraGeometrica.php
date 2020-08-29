<?php

abstract class FiguraGeometrica{

    //Atributos
    protected $_color;
    protected $_perimetro; //Suma de todas las líneas
    protected $_superficie; //Rectangulo y triangulo

    //Constructores
    public function __construct() {

    }
    
    //Getters
    public function getColor() { return $this->_color; }
    
    //Setters
    public function setColor(string $colorP) { $this->_color = $colorP; }

    //Métodos

    //Abstractos
    public abstract function Dibujar();
    protected abstract function CalcularDatos();

    //Virtuales (Se puede sobrescribir en una clase derivada)
    public function ToString() {

        echo "Información de la figura:<br>
        
        -Color: {$this->_color} <br>
        -Perimetro: {$this->_perimetro} <br>
        -Superficie: {$this->_superficie} <br>";
    }
}
