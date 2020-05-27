<?php
    require_once "util.php";
    //echo "Hola";
    
    limpia_entradas($_POST);
    //print_r($_POST);

    $nombre = $_POST["nombre"];
    $size = $_POST["size"];
    $meses = $_POST["meses"];
    $fechaLlegada = date('Y-m-d', strtotime($_POST['fecha']));
    $genero = $_POST["genero"];
    $condiciones = $_POST["condiciones"];
    $personalidad = $_POST["personalidad"];
    $raza = $_POST["raza"];
    $estado = $_POST["estado"];
    $historia = $_POST["historia"];
    
    //codigo para agregar foto



    $nombreFoto = $_FILES["foto"]["name"]; //nombre actual de la foto
    $idNuevoPerro = recuperarProximoId();
    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION); //encontrar la extension de la imagen
    $nuevoNombre = $idNuevoPerro . "." . $extension; //renombrarla
    $directorio = 'img/perros/'; //donde se va a guardar
    $temp_name = $_FILES["foto"]["tmp_name"]; //lugar donde se guarda temporalmente
    

   /* if($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
        header("location: errorPerro.html");
    }else{*/
        if (move_uploaded_file($temp_name,$directorio.$nuevoNombre)){
            $call = agregarPerro($nombre,$size,$meses, $fechaLlegada, $genero, $historia, $condiciones, $personalidad,$raza, $estado);
            
            if (!$call){
                header("location: vista_successPerro");
            }else{
                header("location: vista_errorPerro");
                
            }
        }/*else {
                header("location: vista_errorPerro");
            }}*/
    
    
    
    

?>