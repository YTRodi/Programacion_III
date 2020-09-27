<?php

include_once __DIR__.'/clases/AuthJWT.class.php';
include_once __DIR__.'/clases/FileHandler.class.php';
include_once __DIR__.'/clases/Usuario.class.php';
include_once __DIR__.'/clases/Materia.class.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? 0;
$jwt = $_SERVER['HTTP_TOKEN'] ?? '';

try {

    $jwtDecodificado = AuthJWT::ValidarToken( $jwt );

    // print_r(AuthJWT::GetDatos( $_SERVER['HTTP_TOKEN'] ));

    // print_r($jwtDecodificado);

} catch (\Throwable $e) {

    echo $e;
    
    //var_dump($e->getTrace());

}

switch ($path) {

    case '/usuario':

        switch ($method) {

            case 'POST':

                try {
                    
                    $listaUsuariosJSON = Usuario::ReadUsuarioJSON();
                    
                    $emailUsuario = $_POST['emailUsuario'] ?? '';
                    $password = $_POST['password'] ?? '';
                    
                    $nuevoUsuario = new Usuario($emailUsuario,$password);
                    
                    //!! LINEA A LINEA
                    // $nuevoUsuario->SaveUsuario();

                    
                    // //!! JSON
                    // array_push($listaUsuariosJSON,$nuevoUsuario);
                    // //var_dump($listaUsuariosJSON);
                    // Usuario::SaveUsuarioJSON($listaUsuariosJSON);

                    // //!! SERIALIZADO
                    // $listaUsuariosSer = Usuario::ReadUsuarioSerialize();
                    // array_push($listaUsuariosSer,$nuevoUsuario);
                    // Usuario::SaveUsuarioSerialize($listaUsuariosSer);

                } catch (\Throwable $e) {

                    echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
                    var_dump($e->getTrace());

                }

                break;

            // ?? por si me lo pide!!!!!!!!!!!!!!!!!!!!!
            // ?? por si me lo pide!!!!!!!!!!!!!!!!!!!!!
            // ?? por si me lo pide!!!!!!!!!!!!!!!!!!!!!
            // ?? por si me lo pide!!!!!!!!!!!!!!!!!!!!!
            // ?? por si me lo pide!!!!!!!!!!!!!!!!!!!!!
            case 'GET':

                try {
                    
                    //!! LINEA A LINEA
                    // var_dump(Usuario::ArrayOfUsuarios());


                    // //!! JSON
                    // var_dump(Usuario::ReadUsuarioJSON());

                    // //!! SERIALIZADO
                    // var_dump(Usuario::ReadUsuarioSerialize());

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
                    // echo $nuevoUsuario;

                    // !! LINEA A LINEA
                    // $listaUsersTXT = Usuario::ArrayOfUsuarios();
                    // $loginUser = $nuevoUsuario->verificarUsuario( $listaUsersTXT );
                    // if($loginUser) {
                    //     $datosUsuario = ['email' => $nuevoUsuario->_email, 'type' => 'ADMIN'];
                    //     $token = AuthJWT::Login($datosUsuario);
                    //     print_r($token);
                    // }else {
                    //     echo 'LOGIN SIN ÉXITO :(';
                    // }



                    // !! JSON
                    // $listaUsuariosJSON = Usuario::ReadUsuarioJSON();
                    // // var_dump($listaUsuariosJSON);
                    
                    // $loginUser = $nuevoUsuario->verificarUsuario($listaUsuariosJSON);

                    // if($loginUser){

                    //     //?? LO QUE ME PIDA LA CONSIGNA !!!!
                    //     $datosUsuario = ['email' => $nuevoUsuario->_email, 'type' => 'ADMIN'];

                    //     $token = AuthJWT::Login( $datosUsuario );

                    //     print_r($token);

                    //     echo '</br>Login con éxito!</br>';


                    // }else{

                    //     echo 'LOGIN SIN ÉXITO :(';

                    // }

                } catch (\Throwable $e) {

                    echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
                    var_dump($e->getTrace());

                }

                break;
        }

        break;

    case '/materia':

        if($jwtDecodificado->type === 'ADMIN'){ //Verifico JWT por el header

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

                    var_dump(Materia::ReadMateriaJSON());
    
                    // $listaMaterias = Materia::ReadMateriaJSON();
                    // foreach ($listaMaterias as $key) {

                    //     echo $key . '</br>';

                    // }
                    break;

            }

        }else{

            echo '</br>El usuario no es ADMIN.</br>';

        }

        break;




        // case '/asignacion':
        //     if($jwtDecodificado->type === 'ADMIN'){ //Verifico JWT por el header
        //         switch ($method) {
        //             case 'POST':
        //                 try {
        //                     //Listas
        //                     // $listaAsignaciones = Asignacion::ReadAsignacionJSON();
        //                     // $listaProfesores = Profesor::ReadProfesorJSON();
        //                     // $listaMaterias = Materia::ReadMateriaJSON();

        //                     // //Petición Http del tipo POST
        //                     // $legajoProfesor = $_POST['legajoProfesor'] ?? '';
        //                     // $idMateria = $_POST['idMateria'] ?? '';
        //                     // $turno = $_POST['turno'] ?? '';

        //                     // $nuevaAsignacion = new Asignacion(Asignacion::autoID($listaAsignaciones), $legajoProfesor, $idMateria, $turno );

        //                     // foreach ($listaAsignaciones as $key ) {

        //                     //     if($key->_legajoProfesor === $legajoProfesor &&
        //                     //        $key->_idMateria === $idMateria &&
        //                     //        $key->_turno === $turno){

        //                     //         echo 'No se puede tener el mismo legajo, turno y materia.<br/>';
        //                     //         break;
                                    
        //                     //     }else{

        //                     //         array_push($listaAsignaciones,$nuevaAsignacion);
        //                     //         Asignacion::SaveAsignacionJSON($listaAsignaciones);
        //                     //     }

        //                     // }
        
        //                 } catch (\Throwable $e) {
    
        //                     echo 'Mensaje de error: ' . $e->getMessage() . '</br>';
        //                     var_dump($e->getTrace());
    
        //                 }
        //                 break;
        
        //             case 'GET':
        //                 // var_dump(Materia::ReadMateriaJSON());
        //                 var_dump(Asignacion::ReadAsignacionJSON());
        //                 break;
        //         }
        //     }
        // break;
    
        // }

    default:
        echo 'Ruta inválida.';
        break;


    break;
}

