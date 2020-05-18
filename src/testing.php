<?php
    include_once  "util.php";

if(isset($_GET["id"])){
    $uid = limpia_entrada($_GET["id"]);
    $noUsada=sqlqry("SELECT uid FROM cambio_contrasenia WHERE uid='$uid' AND NOT usada AND timestamp > DATE_SUB(NOW(), INTERVAL 2 HOUR)")->num_rows>0;
    if($noUsada){
        echo "simon";
    } else{
        echo "llave usada";
    }
} else {
    echo "No hay id";
}