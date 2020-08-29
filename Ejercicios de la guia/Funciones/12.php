<?php

    $arrayPrueba = ["hola","mundo","HTML","CSS","JS"];

    function invertirArray($arrayPrueba){

        $arrayRevertido = [];

        foreach ($arrayPrueba as $key) {
            $keyDelArray = strrev($key);
            array_push($arrayRevertido,$keyDelArray);
        }

        return $arrayRevertido;
    }

    var_dump(invertirArray($arrayPrueba));
    
