<?php

    include_once __DIR__.'/core/conectar.php';
    include_once __DIR__.'/models/user.php';


    try {

        // CONEXIÓN.
        $connection_DB = new Conectar();
        $query = $connection_DB->Conexion()->query( 'SELECT * FROM usuarios' );
        // echo 'Cantidad de filas: ' .  $query->rowCount() . '<br/>'; 


        // ====================================================================================================
        // TRAER DATOS

        #1 fetchAll()
        // $users = $query->fetchAll(); // Retorna un [] con el doble de datos que tiene las columnas de la DB ( Una es nombre de la columa y la que sigue es el índice )

        // foreach ($users as $key => $value) {
            
        //     // Puedo acceder tanto por el índice numérico como por el nombre de la columna.
        //     var_dump( $value );
        //     echo '<br/>';
        //     echo $value[ 'nombre' ] . '<br/>';
        //     echo $value[ 2 ] . '<br/>';
        // }

        #2 fetch()
        // while( $row = $query->fetch() ) {

        //     // var_dump( $row );
        //     echo $row[ 'nombre' ] . '<br/>';
        //     echo $row[ 2 ] . '<br/>';
        //     echo '===========<br/>';

        // }

        #3.1 fetch( CONSTANTES )
        // while( $row = $query->fetch( PDO::FETCH_OBJ ) ) {

        //     var_dump( $row ); // StdClass
        //     die();

        // }


        #3.2 fetch( CONSTANTES )
        // $users = $query->fetchAll( PDO::FETCH_CLASS, 'User' );

        // foreach ($users as $key => $value) {

        //     var_dump( $value );
        //     echo '<br/>';
        //     echo $value->saludar();
        // }


        // ====================================================================================================
        // EVITAR SQL INYECTION
        #1 forma ( mala práctica , puedo enviar con get esto '1;DELETE FROM `usuarios` WHERE id = 5' en el value de la key 'id'. PROVOCO LA INYECCIÓN SQL)
        // $id = $_GET[ 'id' ] ?? 0;
        // $query2 = $connection_DB->Conexion()->query( "SELECT * FROM usuarios WHERE id = $id" );

        // $users = $query2->fetchAll();
        // // var_dump( $users[0] );


        // foreach ($users as $key => $value) {
            
        //     var_dump( $value );

        // }

        // =======================================
        // ||        ESTA ME GUSTA MÁS...       ||
        // =======================================
        #2.1 forma ( prepare() y execute  )
        $id = $_GET[ 'id' ] ?? 0;
        $query3 = $connection_DB->Conexion()->prepare( "SELECT * FROM usuarios WHERE id = ?" );

        $query3->execute( [ $id ] ); // Cada elemento del [] va a coincidir con los '?' del prepare().
        $users = $query3->fetchAll();
        // var_dump( $users[0] );

        foreach ($users as $key => $value) {
            
            var_dump( $value );

        }


        #2.2 forma ( bindParam() )
        // $id = $_GET[ 'id' ] ?? 0;
        // $query4 = $connection_DB->Conexion()->prepare( "SELECT * FROM usuarios WHERE id = :id" );

        // // Tengo que hacer un bindParam por cada parámetro que tenga en la query
        // $query4->bindParam( ':id', $id );
        // $query4->execute();
        // $users = $query4->fetchAll();
        // // var_dump( $users[0] );

        // foreach ($users as $key => $value) {
            
        //     var_dump( $value );

        // }


    } catch (\Throwable $e) {
        
        echo $e;

    }
