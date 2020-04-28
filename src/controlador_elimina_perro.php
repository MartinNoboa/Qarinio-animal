<?php
session_start();
require_once "util.php";

$perro = isset($_POST["idperro"]);


$result = eliminar_perro($perro);

if( $result ) {
	$_SESSION["mensaje"]="El perro se eliminó exitosamente";
  }else{
    $_SESSION["error"]="Hubo un error al eliminar el perro";
    
  }
  



?>
