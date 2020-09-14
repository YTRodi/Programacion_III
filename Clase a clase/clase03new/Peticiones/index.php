<?php

include_once __DIR__.'/clases/Auto.php';

$fileNameAutos = './archivos/autos.txt';
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';

switch ($path) {
    case '/auto':
        switch ($method) {
            case 'GET': 
                try {
                    //Línea a línea
                    //var_dump(Auto::ArrayOfAutos());

                    //JSON
                    var_dump(Auto::ReadAutoJSON());

                } catch (\Throwable $e) {
                    echo $e->getMessage() . '<br/>';
                    var_dump($e->getTrace());
                }
                break;
        
            case 'POST':
        
                try {
                    $marca = $_POST['marca'] ?? 'No existe la clave marca.';
                    $modelo = $_POST['modelo'] ?? 'No existe la clave modelo.';
                    $color = $_POST['color'] ?? 'No existe la clave color.';
                    $precio = floatval($_POST['precio'] ?? 'No existe la clave precio.');
        
                    $nuevoAuto = new Auto(rand(1,100),$marca,$modelo,$color,$precio);

                    /** Línea a línea **/
                    //$nuevoAuto->SaveAuto();

                    /** JSON **/
                    // $listaAutosJSON = Auto::ReadAutoJSON();
                    // array_push($listaAutosJSON,$nuevoAuto);
                    // Auto::SaveAutoJSON($listaAutosJSON);

                    /** Serializar **/
                    $listaAutosSer = Auto::ReadAutoSerialize();
                    array_push($listaAutosSer,$nuevoAuto);
                    Auto::SaveAutoSerialize($listaAutosSer);
                    var_dump($listaAutosSer);
                    
                } catch (\Throwable $e) {
                    echo $e->getMessage() . '<br/>';
                    var_dump($e->getTrace());
                }
                break;
        
            case 'DELETE':
        
                Auto::BorrarAutoPorID($fileNameAutos,"a+",35);
                break;
            
            default:
                echo 'Sin ejemplo.<br/>'; 
                break;
        }
        break;
}