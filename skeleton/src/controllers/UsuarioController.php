<?php 

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;
use App\Models\Usuario; // Obj que va a manipular la base de datos usuarios.


// Va a tener los 5 comandos básicos para la entidad.
// getAllUsers
// addUser
// getOneUser
// updateUser
// deleteUser
class UsuarioController {

    public function getAllUsers ( Request $request, Response $response, $args ) {
    
        $rta = Usuario::get();     

        $response->getBody()->write( json_encode( $rta ) );

        // Seteo la cabecera, pq vamos a trabajar con JSON.
        return $response->withHeader( 'Content-type', 'application/json' );

    }

    public function getOneUser ( Request $request, Response $response, $args ) {
    
        $rta = Usuario::find( $args['id'] );

        $response->getBody()->write( json_encode( $rta ) );

        return $response->withHeader( 'Content-type', 'application/json' );
        
    }

    public function addUser ( Request $request, Response $response, $args ) {
    
        // Los parámetros tienen que venir por el body... acá los estoy hardcodeando
        $user = new Usuario;
        $user->nombre = "PRUEBA_NOMBRE";
        $user->apellido = "PRUEBA_APELLIDO";
    
        $rta = $user->save();
        
        $response->getBody()->write( json_encode( $rta ) );

        return $response->withHeader( 'Content-type', 'application/json' );
        
    }

    public function updateUser ( Request $request, Response $response, $args ) {
    
        // Los parámetros tienen que venir por el body... acá los estoy hardcodeando
        $user = Usuario::find( 52 );

        // Hago las modicaciones y vuelvo a guardar
        $user->nombre = "Tanjiro";
        $user->apellido = "Kamado";
    
        $rta = $user->save();
        $response->getBody()->write( json_encode( $rta ) );
        
        return $response;
        
    }

    public function deleteUser ( Request $request, Response $response, $args ) {
    
        // Los parámetros tienen que venir por el body... acá los estoy hardcodeando
        $user = Usuario::find( 51 );

        $rta = $user->delete();
        $response->getBody()->write( json_encode( $rta ) );
        
        return $response;
        
    }
    
}