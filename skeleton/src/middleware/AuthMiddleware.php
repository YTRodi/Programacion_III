<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class AuthMiddleware
{
    // Vamos a recibir el token por la request, nos fijamos si es válido
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        // Si cambio el valor de $valido, me deja entrar o no...
        $valido = !true;

        if ( !$valido ) {

            $response = new Response();
            $response->getBody()->write( 'Prohibido pasar' );
            // throw new \Slim\Exception\HttpForbiddenException( $request );
            return $response->withStatus( 403 );

        } else { // Este else está medio al pelo

            $response = $handler->handle( $request );
            $existingContent = ( string ) $response->getBody();
            $resp = new Response();
            $resp->getBody()->write( $existingContent );

            return $resp;

        }
    }

}