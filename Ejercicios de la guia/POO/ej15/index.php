<?php
include_once './Entidades/FiguraGeometrica.php';
include_once './Entidades/Rectangulo.php';
include_once './Entidades/Triangulo.php';

$miRec = new Rectangulo(4,8);
$miRec->setColor("blue");
$miRec->ToString();

$miTri = new Triangulo(12,15);
$miTri->setColor("yellow");
$miTri->ToString();