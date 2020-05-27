<?php
require_once "util.php";
if(!isset($_SESSION)){
    session_start();
}

$minAge = isset($_POST["minAge"])?limpia_entrada($_POST["minAge"]):0;
$maxAge = isset($_POST["maxAge"])?limpia_entrada($_POST["maxAge"]):144;
$sort = isset($_POST["sort"])?limpia_entrada($_POST["sort"]):"";
$order = isset($_POST["order"])?$_POST["order"]:false;

$result = filterDogs($minAge,$maxAge,check($_POST, "macho"),check($_POST, "hembra"), $sort, $order);

if(http_response_code() == 200 && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        //Des-comentar cuando se hayan agregado imagenes
        $img = "img/perros/".$row["idPerro"].".jpeg";
        //$img = "img/Mario.jpg";
        $name = $row["nombre"];
        $test = $row["fechaLLegada"];
        $id = $row["idPerro"];

        $m = $row["edad"];
        $age = sintaxisEdad($m);

        include("_tarjetaPerro.html");

    }
} else if(http_response_code() == 200) {

} else {
    include ('error.php');
}

?>
