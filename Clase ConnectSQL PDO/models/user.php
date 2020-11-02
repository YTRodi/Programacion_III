<?php 

class User {

    private $id, $nombre, $apellido;

    // public function __construct( $id, $nombre, $apellido ) {

    //     $this->id = $id;
    //     $this->nombre = $nombre;
    //     $this->apellido = $apellido;

    // }

    public function saludar() { return 'Hola soy ' . $this->nombre . '!!<br/>'; }
}