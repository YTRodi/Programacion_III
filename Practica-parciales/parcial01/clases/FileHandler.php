<?php

class FileHandler{
    //Línea a línea
    public function SaveLineToLine(string $fileName = '', string $datos = ''){

        if(!empty($fileName) && !empty($datos)){
            $archivo = fopen($fileName,'a+');
            fwrite($archivo,$datos . PHP_EOL);
            return fclose($archivo) . "<br/>Grabado con éxito! (PATH = '$fileName')";
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }
    }

    //Necesito una instancia de Auto para poder usar está función. (Poco reutilizable)
    public function ReadLineToLine(string $fileName = ''){
        $contenidoDelArchivo = '';

        if($fileName !== ''){
            $archivo = fopen($fileName,'r');
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

    public function BringArray(string $fileName = ''){
        //Traer array
        $linea = "";
        $datos = "";
        $listaAutos = [];

        if($fileName !== ""){
            $archivo = fopen($fileName,'r');
    
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $datos = explode("*",$linea); //Me lo va a separar cada vez que encuentre un *
                
                if(count($datos) === 5){
                    array_push($listaAutos,$datos);
                }
            }
            fclose($archivo);
            
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }

        return $listaAutos;
    }


    //JSON
    public function SaveJSON(string $fileName = '', array $arrayObj = null){
        if(!empty($fileName)){
            if($arrayObj !== null){
                $archivo = fopen($fileName,'w');
                fwrite($archivo,json_encode($arrayObj,JSON_PRETTY_PRINT));
                return fclose($archivo) . "<br/>Grabado con éxito! (PATH = '$fileName')";
            }
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }
    }

    public function ReadJSON(string $fileName = ''){
        $arrayJSON = [];

        if(!empty($fileName)){
            if(file_exists($fileName)){
                $archivo = fopen($fileName,'r');
                $fSize = filesize($fileName);

                if ($fSize > 0) {
                    $fread = fread($archivo,$fSize);
                } else {
                    $fread = '{}';
                }
                fclose($archivo);
                $arrayJSON = json_decode($fread);
            }
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }

        return $arrayJSON;
    }

    //Serializar
    public static function SaveSerialize(string $fileName = '', array $array = null){
        if(!empty($fileName)){
            if($array !== null){
                $archivo = fopen($fileName,'w');
                fwrite($archivo,serialize($array) . '<br/>');
                return fclose($archivo) . "<br/>Grabado con éxito! (PATH = '$fileName')";
            }
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }
    }

    public static function ReadSerialize(string $fileName = ''){
        $array = [];

        if(!empty($fileName)){
            if(file_exists($fileName)){
                $archivo = fopen($fileName,'r');
                $fSize = filesize($fileName);

                if ($fSize > 0) {
                    $fread = fread($archivo,$fSize);
                } else {
                    $fread = '{}';
                }
                fclose($archivo);
                $array = unserialize($fread);
            }
        }else{
            throw new Exception('Filename no puede estar vacio.<br/>');
        }

        return $array;
    }
}