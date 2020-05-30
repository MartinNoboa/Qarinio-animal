<?php 
    include_once("util.php");
//    print_r($_SESSION["id"]);
    $id = $_POST["idUsuario"];

    echo muestraSolicitudes($id); 


?>
