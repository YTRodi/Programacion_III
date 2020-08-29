<?php

    function esPar(int $num){
        $esPar = "";

        // ** HACER CON OPERADOR TERNARIO.
        
        if($num % 2 === 0){
            $esPar = "TRUE <br>";
        }else{
            $esPar = "FALSE <br>";
        }

        return $esPar;
    }
    
    echo esPar(2);
    echo esPar(4);
    echo esPar(6);

    echo esPar(3);
    echo esPar(5);
    echo esPar(7);