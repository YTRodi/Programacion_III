<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;


use Config\Database;
use App\Controllers\UsuarioController;

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

});

$app->run();