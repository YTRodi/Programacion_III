<?php
    $arrayImpares = [];
    $limite = 0;
    $num = 0;

    do {
        $num++;
        if($num % 2 != 0){
            array_push($arrayImpares,$num);
            $limite++;
        }

    } while ($limite < 10);

foreach ($arrayImpares as $key => $value) {
    echo "<br> $key->$value";
}