<?php

class FileHandler{
    public static function EscribirArchivo(string $fileName = "",string $mode = "", string $strAEscribir = ""){
        $pudoEscribir = false;

        if($fileName !== "" && $mode !== ""){
            $archivo = fopen($fileName,$mode);
            
            fwrite($archivo,$strAEscribir . PHP_EOL);

            $pudoEscribir = fclose($archivo) . "<br/>";

        }else{
            echo "<br/>Filename y/o mode no pueden estar vacios.<br/>";
        }

        return  $pudoEscribir;
    }

    public static function LeerArchivo(string $fileName = "",string $mode = ""){
        $contenidoDelArchivo = "";

        if($fileName !== "" && $mode !== ""){
            $archivo = fopen($fileName,$mode);
    
            // $contenidoDelArchivo .= "Contenido del archivo: (marca, modelo, color, precio) <br/>";
            $contenidoDelArchivo .= "AUTOS:<br/>";
    
            while (!feof($archivo)) {
                
                $contenidoDelArchivo .= fgets($archivo) . "<br/>";
            }
    
            fclose($archivo) . "<br/>";
            
        }else{
            $contenidoDelArchivo .= "<br/>Filename y/o mode no pueden estar vacios.<br/>";
        }

        return $contenidoDelArchivo;
    }

    public static function ArchivoToObj(string $fileName = "",string $mode = ""){
        $linea = "";
        $datos = "";
        $listaAutos = [];

        if($fileName !== "" && $mode !== ""){
            $archivo = fopen($fileName,$mode);
    
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $datos = explode("*",$linea);
                /**
                 * INDICE 0 = marca
                 * INDICE 1 = modelo
                 * INDICE 2 = color
                 * INDICE 3 = precio
                 */

                if(count($datos) === 5){
                    $autoNuevo = new Auto($datos[0],$datos[1],$datos[2],$datos[3],floatval($datos[4]));

                    array_push($listaAutos,$autoNuevo);
                }
            }
            echo fclose($archivo) . "<br/>";
            
        }else{
            echo "<br/>Filename y/o mode no pueden estar vacios.<br/>";
        }

        return $listaAutos;
    }

    public static function BorrarAutoPorID(string $fileName = "",string $mode = "",int $idABorrar){
        $arrayAutos = FileHandler::ArchivoToObj($fileName,$mode);
        $lenArray = count($arrayAutos);

        for ($i=0; $i < $lenArray; $i++) { 
            if($arrayAutos[$i]->getID() === $idABorrar){
                unset($arrayAutos[$i]);
                echo "Borrado!";
                break;
            }
        }
        
        FileHandler::BorrarArchivo($fileName); //Elimino el archivo y vuelvo a meter el array de autos nuevo.
        
        foreach ($arrayAutos as $key => $value) {
            FileHandler::EscribirArchivo($fileName,$mode,$value);
        }
    }

    public static function BorrarArchivo(string $fileName = ""){
        return (!empty($fileName)) ? unlink($fileName) : "<br/>Filename no puede estar vacios.<br/>";
    }

    public static function CopiarArchivo(string $fileNameOrigen = "", string $fileNameDestino = ""){
        return (!empty($fileNameOrigen) && !empty($fileNameDestino)) ? copy($fileNameOrigen,$fileNameDestino) : "<br/>fileNameOrigen y fileNameDestino no puede estar vacios.<br/>";
    }
}