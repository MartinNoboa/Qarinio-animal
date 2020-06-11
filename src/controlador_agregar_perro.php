<?php
    require_once "util.php";
    
    limpia_entradas($_POST);

    $nombre = $_POST["nombre"];
    $tamanio = $_POST["size"];
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
    $nuevoNombre = $idNuevoPerro . "."; //renombrarla
    $directorio = 'img/perros/'; //donde se va a guardar
    $temp_name = $_FILES["foto"]["tmp_name"]; //lugar donde se guarda temporalmente
    

    //resize y cortar imagen

    $im1 = imagecreatefromstring(file_get_contents($_FILES["foto"]["tmp_name"]));
    $size = min(imagesx($im1), imagesy($im1));
    $im2 = imagescale(imagecrop($im1, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]),1000,1000);



    //subir foto
    if ( imagejpeg($im2, $directorio.$nuevoNombre."jpeg")){
        $call = agregarPerro($nombre,$tamanio,$meses, $fechaLlegada, $genero, $historia, $condiciones, $personalidad,$raza, $estado);

        if (!$call){
            header("location: vista_successPerro");
        }else{
            header("location: vista_errorPerro");

        }
    }
    
    
    
    

?>