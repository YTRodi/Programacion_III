<?php

class Auto{

    //Atributos
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    //Constructores
    public function __construct(string $marcaP = "", string $colorP = "", float $precioP = 0, DateTime $fechaP = null) {
        $this->_marca = $marcaP;
        $this->_color = $colorP;
        $this->_precio = $precioP;
        $this->_fecha = $fechaP;
    }

    //Métodos
    public function AgregarImpuestos(float $impuesto) {
        $this->_precio += $impuesto;
    }

    public static function MostrarAuto(Auto $auto){
        $infoAuto = "</br>";

        if($auto !== null){
            $infoAuto .= "Color: {$auto->_color} </br>";
            $infoAuto .= "Precio: $ {$auto->_precio} </br>";
            $infoAuto .= "Marca: {$auto->_marca}</br>";

            if($auto->_fecha != null){
                $infoAuto .= "Fecha: {$auto->_fecha->format("Y-m-d")} </br>";
            }
        }        
        
        return $infoAuto;
    }

    public function Equals(Auto $a1, Auto $a2){
        if ($a1->_marca === $a2->_marca) {
            return "True </br>";
        }else{
            return "False </br>";
        }
    }

    public static function Add(Auto $a1, Auto $a2){
        if($a1->Equals($a1,$a2) && $a2->Equals($a1,$a2) && $a1->_color === $a2->_color){
            return "Suma de precios: " . ($a1->_precio + $a2->_precio) . "</br>";
        }else{
            return "Los autos no coindicen (marca y color).</br>";
        }
    }
}