<?php
    require_once "util.php";
    //echo "Hola";
    
    limpia_entradas($_POST);

    $nombre = $_POST["nombre"];
    $size = $_POST["size"];
        
    $meses = $_POST["meses"];

    $fechaLlegada = date('Y-m-d', strtotime($_POST['fechaLlegada']));
    $genero = $_POST["genero"];
    $condiciones = $_POST["condiciones"];
    $personalidad = $_POST["personalidad"];
    $raza = $_POST["raza"];
    $estado = $_POST["estado"];
    $historia = $_POST["historia"];
    $uploadOk = 1;

    $foto = $_FILES["foto"]['name'];
    $dir = "img/perros/".$foto;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $valid_extensions = array("jpg","jpeg","png");
    /* Check file extension */
    if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
       $uploadOk = 0;
    }

     if($uploadOk == 0){
         //error
     }else{
         $imagen = move_uploaded_file($_FILES['file']['tmp_name'],$location);
     }
    
    $perro = agregarPerro($nombre,$size,$meses, $fechaLlegada, $genero, $historia, $condiciones, $personalidad,$raza, $estado);
    echo $imagen;    
    echo ($perro && $imagen);
    
//header("location:catalogo.php");
        

?>