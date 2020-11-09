<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


use Config\Database;
use App\Models\Usuario; // Obj que va a manipular la base de datos usuarios.

require __DIR__ . '/../vendor/autoload.php';


$conn = new Database;

$app = AppFactory::create();
$app->setBasePath( '/Programacion_III/skeleton/public' );






$app->get('/', function (Request $request, Response $response, $args) {

    // $rta = Usuario::get()
    $rta = Usuario::where('id','=','2')
        ->get();
    
    $response->getBody()->write( json_encode( $rta ) );
    return $response;
});


$app->post('/', function (Request $request, Response $response, $args) {

    // Ponerlo en Controllers/UsuarioController.php
    $user = new Usuario;
    $user->nombre = "PRUEBA_NOMBRE";
    $user->apellido = "PRUEBA_APELLIDO";

    $rta = $user->save();
    
    $response->getBody()->write( json_encode( $rta ) );
    return $response;
});


$app->put('/{id}', function (Request $request, Response $response, $args) {

    echo $args['id'] . '<br/>';
    var_dump( $args['id'] );

    // $user = Usuario::find( 10 );
    // $user->nombre = "PRUEBA_NOMBRE";
    // $user->apellido = "PRUEBA_APELLIDO";

    // $rta = $user->save();
    
    // $response->getBody()->write( json_encode( $rta ) );
    return $response;
});

$app->run();