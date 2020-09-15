<?php

include_once __DIR__.'/clases/Usuario.php';
include_once __DIR__.'/clases/Materia.php';
include_once __DIR__.'/clases/Profesor.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? 0;

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
                    echo $e->getMessage() . '<br/>';
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
                    $countLista = count($listaUsuariosJSON);
                    $flag = false;
                    //var_dump($listaUsuariosJSON);
                    //echo $nuevoUsuario;

                    for ($i=0; $i < $countLista; $i++) { 
                        if($listaUsuariosJSON[$i]->_password === $password &&$listaUsuariosJSON[$i]->_email === $emailUsuario){
                            $flag = true;
                            break;
                        }
                    }
                    $retVal = ($flag) ? '<br/>Login exitoso!<br/>' : 'El Usuario no se encuentra en el archivo json';
                    echo $retVal;

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
                    var_dump($listaMateriasJSON);
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

