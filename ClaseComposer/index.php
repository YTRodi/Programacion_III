<?php

require __DIR__ . '/vendor/autoload.php';

use Models\Usuario;
use Models\Animales\Animal;

$animal = new Animal;
$animal->tipo = "Perro";

echo $animal->tipo;

echo '<br/>';

$usuario = new Usuario;
$usuario->nombre = 'Yago';

echo $usuario->nombre;
