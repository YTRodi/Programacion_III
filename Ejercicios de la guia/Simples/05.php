<?php
    //Se puede hacer con arrays, pero el ejercicio pide sin nada de eso.
    function conversorNumToLetras($number){
        
        $numberSTR = "";
        $returnNumber = "";

        if(is_string($number)){
            return "Ustes no ingresó un número. <br>";
        }
        
        if($number >= 20 && $number <= 60){
            //Número redondos
            if($number === 20){
                return "Veinte <br>"; 

            }else if($number === 30){
                return "Treinta <br>"; 

            }else if($number === 40){
                return "Cuarenta <br>"; 

            }else if($number === 50){
                return "Cincuenta <br>"; 

            }else if($number === 60){
                return "Sesenta <br>"; 
            }
            
            $numberSTR = strval($number); //Lo convierto en string.
            
                switch ($numberSTR[0]) {
    
                    case '2':
                        $returnNumber = "Veinti";
                        break;
                    
                    case '3':
                        $returnNumber = "Treinta y ";
                        break;
                    
                    case '4':
                        $returnNumber = "Cuarenta y ";
                        break;
                    
                    case '5':
                        $returnNumber = "Cincuenta y";
                        break;
                }
    
    
                if($numberSTR[1] === "1"){
                    $returnNumber .= "uno <br>";
                    
                }else if($numberSTR[1] === "2"){
                    $returnNumber .= "dos <br>";
                    
                }else if($numberSTR[1] === "3"){
                    $returnNumber .= "tres <br>";
                    
                }else if($numberSTR[1] === "4"){
                    $returnNumber .= "cuatro <br>";
                    
                }else if($numberSTR[1] === "5"){
                    $returnNumber .= "cinco <br>";
                    
                }else if($numberSTR[1] === "6"){
                    $returnNumber .= "seis <br>";
                    
                }else if($numberSTR[1] === "7"){
                    $returnNumber .= "siete <br>";
                    
                }else if($numberSTR[1] === "8"){
                    $returnNumber .= "ocho <br>";
                    
                }else if($numberSTR[1] === "9"){
                    $returnNumber .= "nueve <br>";
                }
            
            return $returnNumber;
            
        }else{
            echo "El número {$number} no está dentro de los parámetros <br>";
        }
    }
    //Posibles errores:
    echo conversorNumToLetras("Esto es una cadena y no un número");
    echo conversorNumToLetras(10);
    echo conversorNumToLetras(19);
    echo conversorNumToLetras(61);
   
    //Pruebas de la función:
    echo conversorNumToLetras(20);
    echo conversorNumToLetras(21);
    echo conversorNumToLetras(22);
    echo conversorNumToLetras(23);
    echo conversorNumToLetras(24);
    echo conversorNumToLetras(25);
    echo conversorNumToLetras(26);
    echo conversorNumToLetras(27);
    echo conversorNumToLetras(28);
    echo conversorNumToLetras(29);

    echo conversorNumToLetras(30);
    echo conversorNumToLetras(31);
    echo conversorNumToLetras(32);
    echo conversorNumToLetras(33);
    echo conversorNumToLetras(34);
    echo conversorNumToLetras(35);
    echo conversorNumToLetras(36);
    echo conversorNumToLetras(37);
    echo conversorNumToLetras(38);
    echo conversorNumToLetras(39);

    echo conversorNumToLetras(40);
    echo conversorNumToLetras(41);
    echo conversorNumToLetras(42);
    echo conversorNumToLetras(43);
    echo conversorNumToLetras(44);
    echo conversorNumToLetras(45);
    echo conversorNumToLetras(46);
    echo conversorNumToLetras(47);
    echo conversorNumToLetras(48);
    echo conversorNumToLetras(49);

    echo conversorNumToLetras(50);
    echo conversorNumToLetras(51);
    echo conversorNumToLetras(52);
    echo conversorNumToLetras(53);
    echo conversorNumToLetras(54);
    echo conversorNumToLetras(55);
    echo conversorNumToLetras(56);
    echo conversorNumToLetras(57);
    echo conversorNumToLetras(58);
    echo conversorNumToLetras(59);
    
    echo conversorNumToLetras(60);
    
?>