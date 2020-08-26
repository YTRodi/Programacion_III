<?php
    // $nombre = "Yago";

    // echo strlen("Hola Mundo");
    // echo "<br>";
    // echo "Hola $nombre"; //Se puede
    // echo "<br>";
    // echo 'Hola $nombre'; //No lo toma con comillas simples.


    //echo $array //No se puede convertir un array a string.
    //ARRAY
    $array = array(1,"HOLA",3);
    
    var_dump($array);
    echo "<br>";

    $array2[0] = 1;
    $array2[1] = 2;
    $array2[4] = "3"; //el 2 y el 3 no se escribieron

    array_push($array2,5);

    echo "<br>";
    var_dump($array2);

    foreach ($array2 as $value) {
        # code...
        echo "<br/>$value";
    }

    echo "<br>";
    echo "<hr>";
    $array_asoc = array("Yago" => 10, "Maggie" => 2, "Cami" => 3);

    $array_asoc["Pepe"] = 8;

    var_dump($array_asoc);
    
    foreach ($array_asoc as $key => $value) {
        # code...
        echo "<br/> clave: $key => valor $value";
    }

    echo "<br>";
    echo "Array ordenado:";
    echo "<br>";

    //Ordenar arrays...
    ksort($array_asoc); //asort() - Ordenan un array asociativo
    var_dump($array_asoc);


    echo "<br>";
    echo "<hr>";
    echo "<hr>";
    echo "<--------FUNCIONES (No son case sensitive)-------->";
    //Como no admite sobrecargas, podemos emularlas así.
    function saludar($nombre, $apellido = ""){
        echo "<br/> Hola $nombre $apellido";
    }

    saludar("Yago");
    Saludar("Yago");
    SALUDAR("Yago","Rodi"); //Sobrecarga emulada.
?>