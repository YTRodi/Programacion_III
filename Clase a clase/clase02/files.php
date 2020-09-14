<?php

include_once __DIR__.'/Auto.php';

$auto = new Auto("Ford 1","azul",rand(100000,1000000));


//$fileName = 'archivo.txt';
$fileName = 'autos.txt';
$archivo = fopen($fileName,'a+');

echo ">>>>>>>>>>>>>{$archivo}\n";

// //echo fread($archivo,filesize($fileName));
// echo "\nfilesize del archivo.txt = " . filesize($fileName) . " bits\n";
// //echo fgets($archivo); //Lee de a una línea

// //**ESCRITURA DE ARCHIVOS
// // $fwrite = fwrite($archivo,'fwrite1' . PHP_EOL);
// // $fwrite = fwrite($archivo,'fwrite2' . PHP_EOL);
// // $fwrite = fwrite($archivo,'fwrite3' . PHP_EOL);
// // echo ">> fwrite escribió: {$fwrite}";
// $fwrite = fwrite($archivo, $auto . PHP_EOL);


// while(!feof($archivo)){
//     echo fgets($archivo) . "\n"; //Leemos todo el archivo (línea por línea).
// }

// $close = fclose($archivo);

// echo "\nfclose = $close";



//!!--------------------------------------------------------------------
//**SALTO DE LINEA (CONSTANTE IMPORTANTE);
//PHP_EOL = salto de línea de acuerdo al sistema operativo

//fopen() = te devuelve un indentificador del archivo.
//fread()(archivo que abrimos, cantidad de bytes que queremos leer) LEEMOS TOOD
//filesize 
//fgets() = Leemos una sola línea.
//feof() = Nos dice si el cursor está al final del archivo.

//**Escritura de archivos
//fwrite() = escribe y me deja el puntero al final del archivo.


//**Copiar archivos (devuelve bool)


//**Borrar un archivo (devuelve bool)