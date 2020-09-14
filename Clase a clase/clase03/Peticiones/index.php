<?php

include_once __DIR__.'/clases/Auto.php';

$fileNameAutos = "./archivos/autos.txt";
$method = $_SERVER['REQUEST_METHOD'];
//$path = $_SERVER['PATH_INFO']; //por ejemplo, localhost/ProgramacionIII/index.php/autos (Y que me muestre todos los autos por get por ejemplo).

switch ($method) {
    case 'GET': 

        try {
            echo Auto::LeerArchivo($fileNameAutos,"a+");
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
        break;

    case 'POST':

        try {
            $marca = $_POST['marca'] ?? 'No existe la clave marca.';
            $modelo = $_POST['modelo'] ?? 'No existe la clave modelo.';
            $color = $_POST['color'] ?? 'No existe la clave color.';
            $precio = floatval($_POST['precio'] ?? 'No existe la clave precio.');

            $nuevoAuto = new Auto(rand(1,100),$marca,$modelo,$color,$precio);
            
            if(Auto::EscribirArchivo($fileNameAutos,"a+",$nuevoAuto)){
                echo "Alta exitosa.<br/>";
                echo "Redireccionando a la página principal...";
                header("refresh:3;url=./formularios/homepage.html");
            }else{
                echo "No se pudo dar de alta.";
            }
            
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
        break;

    case 'DELETE':

        Auto::BorrarAutoPorID($fileNameAutos,"a+",35);
        break;
    
    default:
        echo 'Sin ejemplo.<br/>'; 
        var_dump(Auto::ArchivoToObj($fileNameAutos,"a+"));
        break;
}

//$nuevoAuto = new Auto($marca,$modelo,$color,$precio);
// $listaAutos = [];
//echo Files::EscribirArchivo($fileName,"a+",$nuevoAuto);

//echo Files::LeerArchivo($fileNameAutos,"a+");

// echo "<pre>";
//var_dump(Files::ArchivoToObj($fileName,"a+"));
// echo "<pre/>";

// $listaAutos = Files::ArchivoToObj($fileName,"a+");
// var_dump($listaAutos);

//echo Files::BorrarArchivo($fileName);

//echo Files::CopiarArchivo($fileName,"./copiaAutos.txt");