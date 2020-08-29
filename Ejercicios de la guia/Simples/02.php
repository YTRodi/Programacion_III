<?php

    $fechaServidor = date(DATE_RFC2822);

    echo $fechaServidor;
    echo "<br/>";

    $mesActual = date("m");

    echo $mesActual;
    echo "<br/>";

    if($mesActual >= "06" && $mesActual <= "09") {
        echo "Es invierno";
    }else if($mesActual >= "09" && $mesActual <= "03"){
        echo "Es primavera";
    }else if($mesActual >= "03" && $mesActual <= "06"){
        echo "Es verano";
    }

    // }else{
    //     echo "Es otoño";
    // }