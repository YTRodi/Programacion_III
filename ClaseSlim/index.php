<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// Hay que hacer una pequeña modificación
// Hay que indicar cuando no está en la raíz del servidor.
$app->setBasePath( '/Programacion_III/ClaseSlim' );


// $app->get('/', function (Request $request, Response $response, $args) {

//     $response->getBody()->write( "Hello world!" ); // El método 'write' solo recibe strings

//     try {

//         $db_connection = new PDO( 'mysql:host=localhost;dbname=dbprueba_000webhost;', 'root', '' );


//         if( !$db_connection ){
//             echo 'no se pudo conectar al servidor' . '<br/';
//         }else {
//             echo 'conectado con éxito!' . '<br/>';

        
//             $query = $db_connection->query( 'SELECT * FROM usuarios' );
//             echo 'Cantidad de filas: ' .  $query->rowCount() . '<br/>'; 

//             #1 fetchAll()
//             $users = $query->fetchAll(); // Retorna un [] con el doble de datos que tiene las columnas de la DB ( Una es nombre de la columa y la que sigue es el índice )

//             // foreach ($users as $key => $value) {
                
//             //     // Puedo acceder tanto por el índice numérico como por el nombre de la columna.
//             //     var_dump( $value );
//             //     // echo '<br/>';
//             //     // echo $value[ 'nombre' ] . '<br/>';
//             //     // echo $value[ 2 ] . '<br/>';
//             // }


//             // Trato de INSERTAR 
//             //! FUNCIONA!!!!!!!!!!!!!!!!!!!!!!!!!!!
//             // $query2 = $db_connection->query( "INSERT INTO usuarios (nombre, email) VALUES ('Perlita','perlus@yahoo.com')" );

//             echo '-----------------------------------------------------------<br/>';
//             var_dump($users);
//         }
//     } catch (\Throwable $e) {
//         echo $e->getMessage();
//     }
    

//     return $response;

// });


// No es lo mismo /users que /users/, si queremos tener las dos rutas usamos:
// /users[/] = con los [] le decimos que es opcional
$app->get('/users[/]', function (Request $request, Response $response, $args) {

    $url = $request->getUri();
    $response->getBody()->write( "Estoy en: " . $url . "<br/>");
    $response->getBody()->write( "Hello users! GET" );

    return $response;
});


// RUTAS CON PARÁMETROS: Voy a requerir un id y el nombre del usuario por ejemplo
$app->get('/user/{id}/{user_name}', function (Request $request, Response $response, $args) {

    $body = json_encode( $args );
    $response->getBody()->write( $body );

    $newResponse = $response->withHeader( 'Content-type', 'application/json' ); // Para que me lo formatee a JSON
    return $newResponse;
});


$app->post('/users[/]', function (Request $request, Response $response, $args) {

    #1.1 - HEADERS
    // $one_header = $request->getHeader('api_key'); // Obtenemos una cabecera en específico ( api_key = EJEMPLO )
    // $headers = $request->getHeaders(); // Obtenemos todas la cabeceras
    // var_dump( ($one_header) );
    // $response->getBody()->write( json_encode( $headers, JSON_PRETTY_PRINT ) );


    #2 - ESTADOS
    // $status = $response->getStatusCode();
    // $response->getBody()->write( json_encode( $status ) );


    #3 - NUEVO ESTADO ( El header Content-type va a ser del tipo JSON ( SET ) )
    $data = [ 'name' => 'Bob', 'age' => 40 ];
    $payload = json_encode( $data );
    $response->getBody()->write( $payload );
    
    // withHeader( #1 header, #2 que le voy a setear ) y luego le cambio el estado.
    $newResponse = $response->withHeader( 'Content-type', 'application/json' )->withStatus( 201 ); 

    var_dump( $newResponse );
    return $newResponse;
});


// RECIBIR PARÁMETROS POR EL BODY EN UNA PETICIÓN POST, PUT Y DELETE ( getParsedBody() = nos retorna un objeto )
$app->post('/products[/]', function (Request $request, Response $response, $args) {

    $parsedBody = $request->getParsedBody();

    $response->getBody()->write( json_encode( $parsedBody ) );
    $newResponse = $response->withHeader( 'Content-type', 'application/json' );

    return $newResponse;
    
});


// ANY ROUTE ( no discrimina entre los verbos )
$app->any('/books/[{id}]', function ($request, $response, array $args) {
    // Apply changes to books or book identified by $args['id'] if specified.
    // To check which method is used: $request->getMethod();
});


// CUSTOM ROUTE ( usamos 'map' para restringir que rutas queremos manejar. )
$app->map(['GET', 'POST'], '/books', function ($request, $response, array $args) {
    // Create new book or list all books
});


// GROUP ( Cualquier método que venga al path /mascota, entran aca )
$app->group('/mascota', function ( RouteCollectorProxy $group ) {

    // Este path se concatena con el anterior, es decir, '/mascota/123'
    $group->get('/{id}', function (Request $request, Response $response, $args) {

        $body = json_encode( $args );
        $response->getBody()->write( $body );

        $newResponse = $response->withHeader( 'Content-type', 'application/json' ); // Para que me lo formatee a JSON
        return $newResponse;
    });

    $group->post('/', function (Request $request, Response $response, $args) {

        $response->getBody()->write( 'POST en: ' . $request->getUri() );
        
        return $response;
    });

});

$app->run();