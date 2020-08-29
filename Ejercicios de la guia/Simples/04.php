<?php
    $a = 10;
    $b = 50;
    $result = 0;
    $operador = "+";

    switch ($operador) {
        case '+':
            $result = $a + $b;
            echo "Suma: $result";
            break;
        
        case '-':
            $result = $a - $b;
            echo "Resta: $result";
            break;

        case '*':
            $result = $a * $b;
            echo "Multiplicación: $result";
            break;
    
        case '/':
            $result = $a / $b;
            echo "Divisón: $result";
            break;
    }