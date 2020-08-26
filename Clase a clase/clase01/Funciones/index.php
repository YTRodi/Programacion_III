<?php
/**
 * Diferencias entre include y requiere:
 * Si yo pongo un include, no genera un error fatal.
 * Si no puede incluir un archivo el programa sigue funcionando.
 */
echo "<--------FUNCIONES (No son case sensitive)-------->";

// include "funciones.php"; //Es como si trajera y pegara todo el código acá.
// //include "funciones.php"; //No se puede redeclarar la misma función.
// include "funciones2.php"; //warning
// //Antes de incluir, va a chequear si fue incluido no lo va a incluir dos veces
// include_once "funciones.php";


// require "funciones.php"; //"Sin esto no va a funcionar nada"
// require "funciones2.php"; // FALTA ERROR!


// ** Indicar la ruta física si el archivo se encuentra en otra carpeta. (Ruta relativa)
include "./func/funciones.php";
include_once "./func/funciones.php";
include_once "./func/math.php";

sumar();
saludar("Yago");
Saludar("Yago");
SALUDAR("Yago","Rodi"); //Sobrecarga emulada.