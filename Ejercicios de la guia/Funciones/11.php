<?php
    function potenciaNumero($base, $exp){
        return pow($base,$exp);
    }

    $strBuilder = "";

    //For para la base
    for ($base=1; $base <= 4; $base++) { 
        
        echo "<br>";
        echo "Las 4 primeras potencias del número $base son: ";
        
        //For para el exponente
        for ($exp=1; $exp <= 4; $exp++) { 

            echo potenciaNumero($base,$exp);

            $retVal = ($exp != 4) ? ", " : "." ; //Operador ternario
            echo "{$retVal}"; 
            
            // if($exp != 4){
            //     echo ", ";
            // }else{
            //     echo ".";
            // }
        }
    }
    