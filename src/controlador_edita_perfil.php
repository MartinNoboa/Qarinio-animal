<?php
    require_once 'util.php';
    limpia_entradas($_POST);
    $id = $_POST["idUsuario"];
    $nombre = $_POST["nombre"];
    $apellido=$_POST["apellido"];
    $telefono=$_POST["telefono"];
    $principal=$_POST["principal"];
    $secundaria=$_POST["secundaria"];
    $numExt = $_POST["numExt"];
    $numInt=$_POST["numInt"];
    $cp=$_POST["cp"];
    $colonia=$_POST["colonia"];
    $ciudad=$_POST["ciudad"];
    $estado=$_POST["estado"];
    $fecha=$_POST["fechaNacimiento"];
    echo editarPerfil($id, $nombre, $apellido, $telefono, $principal, $secundaria, $numExt, $numInt, $cp, $colonia, $ciudad, $estado, $fecha);


?>
