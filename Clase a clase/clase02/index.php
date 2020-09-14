<?php
include_once __DIR__.'/Auto.php';

// //var_dump($_GET);

// $marca = $_GET['marca'] ?? "";
// $color = $_GET['color'] ?? "";
// $precio = $_GET['precio'] ?? 0; //Valor nullish, si precio existe se escribe el precio y si no, es 0.

// // ?? o isset (IDEM)
// if(isset($_GET['precio'])){
//     $precio = $_GET['precio'];
// }

// echo "<hr>";
// echo 'Método $_POST </br>';
// //var_dump($_POST);

// echo "<hr>";
// echo 'Método $_REQUEST </br>'; //Comodín, me funciona en GET y POST.
// var_dump($_REQUEST);

// echo "<hr>";
// echo 'Método $_SERVER </br>'; //Info del servidor
// var_dump($_SERVER);

echo "<hr>";
echo "<hr>";
//$autito = new Auto("Ford","Negro",150000);

$method = $_SERVER['REQUEST_METHOD']; //
$path_info = $_SERVER['PATH_INFO']; //Entidad (ejemplo: clase auto)

switch ($method) {
    case 'POST': //en el body, se leen con POST
        # code...
        $marca = $_POST['marca'] ?? "";
        $color = $_POST['color'] ?? "";
        $precio = $_POST['precio'] ?? 0;
    break;
    
    case 'GET': //Los que estan en la cabecera (url), uso GET
        $m = $_GET['marca'] ?? "";
        $c = $_GET['color'] ?? "";
        $p = $_GET['precio'] ?? 0;
    break;
    
    case 'PUT':
        # code...
    break;
    
    case 'DELETE':
        # code...
    break;
}

//$nuevoAuto = new Auto($marca, $color, $precio);//POST
$nuevoAutoPost = new Auto($m, $c, $p);//GET

//echo $nuevoAuto->MostrarAuto($nuevoAuto);
echo $nuevoAutoPost->MostrarAuto($nuevoAutoPost);