<?php

include_once "../ej18/Clases/Garage.php";
include_once "../ej18/Clases/Auto.php";

$garage = new Garage("Pikachu garage",170);
$a1 = new Auto("Mitsubishi", "Azul", 500000, new DateTime("now"));
$a2 = new Auto("Ford", "Negro", 1000000);
$a3 = new Auto("Fiat", "Azul");

echo $garage->Add($a1);
echo $garage->Add($a1); //Repetido
echo $garage->Add($a2);
echo $garage->Add($a3);

echo $garage->MostrarGarage();
echo $garage->Remove($a2);
echo $garage->Remove($a2); //El auto no está en el garage.
//var_dump($garage);
echo $garage->MostrarGarage();
echo $garage->Add($a2);
echo $garage->MostrarGarage();
//TODO OK

echo "<p style = 'color:red;' >hola en rojo</p>";
echo "<p style = 'color:violet;' >hola en violeta</p>";
echo "<p style = 'color:white; background-color: black;'>hola en blanco con fondo negro</p>";