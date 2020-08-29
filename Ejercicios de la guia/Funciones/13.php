<?php

    function invertirPalabra(string $palabra, int $max){

        $arrayPalabras = ["Recuperatorio","Parcial","Programacion"];
        $lenPalabra = strlen($palabra);
        $strRetorno = "";

        if(!is_string($palabra)){ return $strRetorno .= "El primer parámetro no es un string. <br>";}

        if(is_string($max)){ return $strRetorno .= "El segundo parámetro no es un número. <br>";}

        if($lenPalabra <= $max){

            if(in_array($palabra,$arrayPalabras)){
                return 0 . "<br>";
            }else{
                return 1 . "<br>";
            }

        }else{

            $strRetorno .= "El máximo no puede sobrepasar el largo de la palabra. <br>";
        }

        return $strRetorno;

    }

    //Errores
    echo "Errores: <br>";
    echo invertirPalabra("hola mundo",9); // El máximo no puede sobrepasar el largo de la palabra.
    echo invertirPalabra("hola mundo",10); // 1


    //Verificaciones
    echo "<br> Verificaciones: <br>";
    echo invertirPalabra("Recuperatorio",13); //0 
    echo invertirPalabra("Parcial",7); //0
    echo invertirPalabra("Programacion",12); //0