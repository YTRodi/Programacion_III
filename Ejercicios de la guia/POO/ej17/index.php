<?php

include_once '../ej17/Clases/Auto.php';

$autoUno = new Auto("Ford", "Negro");
$autoDos = new Auto("Ford", "Blanco");
//$autoDos = new Auto("Ford", "Negro");

$autoTres = new Auto("Fiat", "Rojo", 500000);
$autoCuatro = new Auto("Fiat", "Rojo", 250000);

$autoCinco = new Auto("Mitsubishi", "Azul", 500000, new DateTime("now"));

$autoTres->AgregarImpuestos(1500);
$autoCuatro->AgregarImpuestos(1500);
$autoCinco->AgregarImpuestos(1500);

echo Auto::Add($autoUno,$autoDos); //Los autos no coindicen (marca y color).

echo $autoUno->Equals($autoUno,$autoDos);
echo $autoUno->Equals($autoUno,$autoCinco);

echo "</br> Auto 1:";
echo Auto::MostrarAuto($autoUno);

echo "</br>Auto 3:";
echo Auto::MostrarAuto($autoTres);

echo "</br>Auto 5:";
echo Auto::MostrarAuto($autoCinco);

echo "<hr>";
echo "MÉTODOS MÁGICOS</br>";
echo $autoUno;
echo "</br>";
echo $autoUno->_marca;
echo $autoUno->_color;
echo $autoUno->_precio;

echo "</br>";
echo $autoUno->_marca;
echo "</br>";
$autoUno->_marca = "pepe";
echo "</br>";
echo $autoUno->_marca;