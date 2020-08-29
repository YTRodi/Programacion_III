<?php

    $lapicera1 = ["color" => "", "marca" => "", "trazo" => "", "precio" => 0];

    $lapicera2 = ["color" => "", "marca" => "", "trazo" => "", "precio" => 0];

    $lapicera3 = ["color" => "", "marca" => "", "trazo" => "", "precio" => 0];

    $lapicera1["color"] = "Azul";
    $lapicera1["marca"] = "Bic";
    $lapicera1["trazo"] = "Medio";
    $lapicera1["precio"] = 50;
    
    $lapicera2["color"] = "Roja";
    $lapicera2["marca"] = "Micro";
    $lapicera2["trazo"] = "grueso";
    $lapicera2["precio"] = 70;
    
    $lapicera3["color"] = "Violeta";
    $lapicera3["marca"] = "Faber-Castell";
    $lapicera3["trazo"] = "Fino";
    $lapicera3["precio"] = 150;
    
    $lapiceraMaster = [$lapicera1, $lapicera2, $lapicera3];
    
    foreach ($lapiceraMaster as $keyMaster) {
        foreach ($keyMaster as $key => $value) {
            echo "key: {$key} - value: {$value} <br>";  
        }
    }