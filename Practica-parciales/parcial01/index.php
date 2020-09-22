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
include_once __DIR__.'/clases/Asignacion.class.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? 0;

//JWT -----------------------------------------------------------------------------------
$key = "ILoveMC";
try {

    $token = $_SERVER['HTTP_TOKEN'] ?? '';
    $decoded = JWT::decode($token, $key, array('HS256'));
    // print_r($decoded);

} catch (\Throwable $e) {

    echo '</br>Token Incorrecto.</br>';

}
 
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

                    echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
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

                        //payload (Creo mis claims personalizados)
                        $payload = ['dataUser' => $nuevoUsuario->_email, 'type' => 'ADMIN'];
                        $token = JWT::encode($payload,$key);

                        echo $token;

                        echo '<</brLogin con éxito!<</br';

                    }else{

                        echo 'LOGIN SIN ÉXITO :(';

                    }

                } catch (\Throwable $e) {

                    echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
                    var_dump($e->getTrace());

                }
                break;
        }
        break;

    case '/materia':
        if($decoded->type === 'ADMIN'){ //Verifico JWT por el header
            switch ($method) {
                case 'POST':
                    try {

                        $listaMateriasJSON = Materia::ReadMateriaJSON();

                        $nombreMateria = $_POST['nombreMateria'] ?? '';
                        $cuatrimestre = $_POST['cuatrimestre'] ?? '';
    
                        $nuevaMateria = new Materia(Materia::autoID($listaMateriasJSON),$nombreMateria,$cuatrimestre);

                        array_push($listaMateriasJSON,$nuevaMateria);
                        Materia::SaveMateriaJSON($listaMateriasJSON);
    
                    } catch (\Throwable $e) {

                        echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
                        var_dump($e->getTrace());

                    }
                    break;
    
                case 'GET':
                    // var_dump(Materia::ReadMateriaJSON());
    
                    $listaMaterias = Materia::ReadMateriaJSON();
                    foreach ($listaMaterias as $key) {

                        echo $key . '</br>';

                    }
                    break;
            }
        }
        break;

        case '/asignacion':
            if($decoded->type === 'ADMIN'){ //Verifico JWT por el header
                switch ($method) {
                    case 'POST':
                        try {
                            //Listas
                            $listaAsignaciones = Asignacion::ReadAsignacionJSON();
                            $listaProfesores = Profesor::ReadProfesorJSON();
                            $listaMaterias = Materia::ReadMateriaJSON();

                            //Petición Http del tipo POST
                            $legajoProfesor = $_POST['legajoProfesor'] ?? '';
                            $idMateria = $_POST['idMateria'] ?? '';
                            $turno = $_POST['turno'] ?? '';

                            $nuevaAsignacion = new Asignacion(Asignacion::autoID($listaAsignaciones), $legajoProfesor, $idMateria, $turno );

                            foreach ($listaAsignaciones as $key ) {

                                if($key->_legajoProfesor === $legajoProfesor &&
                                   $key->_idMateria === $idMateria &&
                                   $key->_turno === $turno){

                                    echo 'No se puede tener el mismo legajo, turno y materia.<br/>';
                                    break;
                                    
                                }else{

                                    array_push($listaAsignaciones,$nuevaAsignacion);
                                    Asignacion::SaveAsignacionJSON($listaAsignaciones);
                                }

                            }
        
                        } catch (\Throwable $e) {
    
                            echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
                            var_dump($e->getTrace());
    
                        }
                        break;
        
                    case 'GET':
                        // var_dump(Materia::ReadMateriaJSON());
                        var_dump(Asignacion::ReadAsignacionJSON());
                        break;
                }
            }
            break;
    
        case '/profesor':
        if($decoded->type === 'ADMIN'){ //Verifico JWT por el header
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

                            throw new Exception('</br>Legajo repetido!</br>');

                        }
    
                    } catch (\Throwable $e) {

                        echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
                        var_dump($e->getTrace());

                    }
                    break;

                case 'GET':
                    var_dump(Profesor::ReadProfesorJSON());

                    $listaProfes = Profesor::ReadProfesorJSON();
                    foreach ($listaProfes as $key) {

                        echo $key . '</br>';

                    }
                    break;
            }
        }
        break;
}

