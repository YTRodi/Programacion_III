<?php

class Conectar {

    private $driver, $host, $user, $pass, $database;
    
    public function __construct() {
        
        $db_conf = include_once './config/db.php'; // Traigo un array asociativo.
        $this->driver = $db_conf['driver'];
        $this->host = $db_conf["host"];
        $this->user = $db_conf["user"];
        $this->pass = $db_conf["pass"];
        $this->database = $db_conf["database"];
        
    }

    public function Conexion() {

        $str_connection = $this->driver . ':host=' . $this->host . ';' . 'dbname=' . $this->database;
        
        return new PDO( $str_connection, $this->user, $this->pass );
    }


}