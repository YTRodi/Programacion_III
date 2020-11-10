<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

use Config\Database;
use App\Controllers\UsuarioController;

// Middleware
use App\Middleware\JsonMiddleware;
use App\Middleware\AuthMiddleware;

// No los uso acá pq los uso en el JsonMiddleware.
// use Psr\Http\Message\ServerRequestInterface as Request;
// use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
// use Slim\Psr7\Response;

require __DIR__ . '/../vendor/autoload.php';


$conn = new Database;

$app = AppFactory::create();
$app->setBasePath( '/Programacion_III/skeleton/public' );

$app->group( '/users', function ( RouteCollectorProxy $group ) {

    $group->get( '[/]', UsuarioController::class . ':getAllUsers' );

    $group->post( '[/]', UsuarioController::class . ':addUser' );

    $group->get( '/{id}', UsuarioController::class . ':getOneUser' );

    $group->put( '/{id}', UsuarioController::class . ':updateUser' );

    $group->delete( '/{id}', UsuarioController::class . ':deleteUser' );

})->add( new AuthMiddleware )->add( new JsonMiddleware );


// $app->group( '/users', function ( RouteCollectorProxy $group ) {

//     $group->get( '[/]', UsuarioController::class . ':getAllUsers' );

//     $group->post( '[/]', UsuarioController::class . ':addUser' );

//     $group->get( '/{id}', UsuarioController::class . ':getOneUser' );

//     $group->put( '/{id}', UsuarioController::class . ':updateUser' );

//     $group->delete( '/{id}', UsuarioController::class . ':deleteUser' );

// })->add( function (Request $request, RequestHandler $handler) {

//     // Agrego un middleware para agregarle en el header el application/json

//     $response = $handler->handle( $request );

//     $response = new Response(); 

//     $response->withHeader( 'Content-type', 'application/json' );

//     return $response;
// });

$app->run();