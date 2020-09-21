<?php
/**
 * INSTARLA JWT DENTRO DE LA CARPETA DEL PARCIAL
 * composer require firebase/php-jwt
 */
require __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT; //namespace

include_once __DIR__.'/clases/Usuario.php';
include_once __DIR__.'/clases/Materia.php';
include_once __DIR__.'/clases/Profesor.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? 0;

//JWT -----------------------------------------------------------------------------------
$key = "ILoveMC";
$token = '';

// $payload = array(
//     //Hace los claims con todo lo que necesitemos
//     "iss" => "http://example.org",
//     "aud" => "http://example.com",
//     "iat" => 1356999524,
//     "nbf" => 1357000000,
//     "email" => "maggie@gmail.com",
//     "type" => "admin"
// );  
//$jwt = JWT::encode($payload, $key);
//print_r($jwt);

//Obtenemos el token (Decodifico)
// $token = $_SERVER['HTTP_TOKEN'] ?? '';
// try {
//     //Si el token que me mandan es CORRECTO me devuelve => Objecto standart class con todos los claims.
//     //Si el token que me mandan NO ES CORRECTO me devuelve => fatal error
//     //var_dump($_SERVER['HTTP_TOKEN']);
//     $decoded = JWT::decode($token, $key, array('HS256'));
    
//     print_r($decoded);
//     //die(); 

// } catch (\Throwable $e) {
//     echo 'error en jwt decode';
//     //** RETORNAR UN JSON CON MENSAJE DE ERROR!!!!!!!!!!!!!!!!!!
// }

$token = $_SERVER['HTTP_TOKEN'] ?? '';
echo $token;
$decoded = JWT::decode($token, $key, array('HS256'));
//echo $token;
print_r($decoded);

 
switch ($path) {
    case '/usuario':
        switch ($method) {
            case 'POST':
                try {
                    $emailUsuario = $_POST['emailUsuario'] ?? '';
                    $password = $_POST['password'] ?? '';

                    $nuevoUsuario = new Usuario($emailUsuario,$password);

                    $listaUsuariosJSON = Usuario::ReadUsuarioJSON();
                    array_push($listaUsuariosJSON,$nuevoUsuario);
                    //var_dump($listaUsuariosJSON);
                    Usuario::SaveUsuarioJSON($listaUsuariosJSON);

                } catch (\Throwable $e) {
                    echo 'Mensaje de error: ' . $e->getMessage() . '<br/>';
                    var_dump($e->getTrace());
                }
                break;
        }
        break;

    case '/login':
        switch ($method) {
            case 'POST':
                try {
                    $emailUsuario = $_POST['emailUsuario'] ?? '';
                    $password = $_POST['password'] ?? '';

                    $nuevoUsuario = new Usuario($emailUsuario,$password);

                    $listaUsuariosJSON = Usuario::ReadUsuarioJSON();
                    $loginUser = $nuevoUsuario->verificarUsuario($listaUsuariosJSON);

                    if($loginUser){

                        //JWT (Creo mis claims personalizados)
                        $payload = ['dataUser' => $nuevoUsuario->_email];

                        // echo 'LOGIN CON ÉXITO!';
                        //$jwt = JWT::encode($payload,$key);
                        $token = JWT::encode($payload,$key);

                        echo $token;

                        echo '</br>Login con éxito!</br>';

                    }else{
                        echo 'LOGIN SIN ÉXITO :(';
                    }

                } catch (\Throwable $e) {
                    echo 'Mensaje de error: ' . $e->getMessage() . '<br/>';
                    var_dump($e->getTrace());
                }
                break;
        }
        break;

    case '/materia':
        switch ($method) {
            case 'POST':
                try {
                    $nombreMateria = $_POST['nombreMateria'] ?? '';
                    $cuatrimestre = $_POST['cuatrimestre'] ?? '';

                    $nuevaMateria = new Materia(0,$nombreMateria,$cuatrimestre);

                    $listaMateriasJSON = Materia::ReadMateriaJSON();
                    $nuevaMateria->_id = Materia::autoID($listaMateriasJSON);
                    array_push($listaMateriasJSON,$nuevaMateria);
                    //var_dump($listaMateriasJSON);
                    Materia::SaveMateriaJSON($listaMateriasJSON);

                } catch (\Throwable $e) {
                    echo 'Mensaje de error: ' . $e->getMessage() . '<br/>';
                    var_dump($e->getTrace());
                }
                break;

            case 'GET':
                var_dump(Materia::ReadMateriaJSON());

                $listaMaterias = Materia::ReadMateriaJSON();
                foreach ($listaMaterias as $key) {
                    echo $key . '<br/>';
                }
                break;
        }
        break;
    
        case '/profesor':
            switch ($method) {
                case 'POST':
                    try {
                        $legajo = $_POST['legajo'] ?? '';
                        $nombreProfesor = $_POST['nombreProfesor'] ?? '';
                        $nuevoProfesor = new Profesor($legajo,$nombreProfesor);
                        
                        $listaProfesoresJSON = Profesor::ReadProfesorJSON();
                        $legajoRepetido = $nuevoProfesor->LegajoUnico($listaProfesoresJSON);

                        if(!$legajoRepetido){
                            array_push($listaProfesoresJSON,$nuevoProfesor);
                            Profesor::SaveProfesorJSON($listaProfesoresJSON);
                        }else{
                            throw new Exception('Legajo repetido!');
                        }
    
                    } catch (\Throwable $e) {
                        echo 'Mensaje de error: ' . $e->getMessage() . '<br/>';
                        var_dump($e->getTrace());
                    }
                    break;

                case 'GET':
                    var_dump(Profesor::ReadProfesorJSON());

                    $listaProfes = Profesor::ReadProfesorJSON();
                    foreach ($listaProfes as $key) {
                        echo $key . '<br/>';
                    }
                    break;
            }
            break;
}

