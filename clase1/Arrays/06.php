<?php

    // $miArray[0] = rand(0,10);
    // $miArray[1] = rand(0,10);
    // $miArray[2] = rand(0,10);
    // $miArray[3] = rand(0,10);
    // $miArray[4] = rand(0,10);

    $array = array(); //array vacio.
    $totalNotas = 0;

    for ($i=0; $i < 5; $i++) {
        $array[$i] = rand(1,10);
    }

    foreach ($array as $value) {
        $totalNotas += $value;
    }
    
    //$promedio = $totalNotas / count($array);
    $promedio = array_sum($array) / count($array);

    if($promedio < 6){
        echo "Los promedios son menores a 6";
    }else if ($promedio == 6){
        echo "Los promedios son iguales a 6";
    }else{
        echo "Los promedios son mayores a 6";
    }

    echo "<br/>";
    echo "Promedio de notas: $promedio";
    