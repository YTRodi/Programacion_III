<?php
//require_once "./funciones/math.php";

//Como no admite sobrecargas, podemos emularlas así.
function saludar($nombre, $apellido = ""){
    echo "<br/> Hola $nombre $apellido";
}