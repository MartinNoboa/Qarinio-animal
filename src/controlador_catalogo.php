<?php
require_once "util.php";
if(!isset($_SESSION)){
    session_start();
}
$_POST = limpia_entradas($_POST);

$minAge = $_POST["minAge"]??0;
$maxAge = $_POST["maxAge"]??144;
$sort = $_POST["sort"]??"";
$order = $_POST["order"]??false;
$busq = $_POST["busq"]??"";
$raza = $_POST["raza"]??0;
$personalidad = $_POST["personalidad"]??0;
$condicion = $_POST["condicion"]??0;
$estado = $_POST["estado"]??"Disponible";

$result = filterDogs(
                $busq,
                $minAge,
                $maxAge,
                check($_POST, "macho"),
                check($_POST, "hembra"),
                check($_POST, "pequeno"),
                check($_POST, "mediano"),
                check($_POST, "grande"),
                $raza,
                $personalidad,
                $condicion,
                $estado,
                $sort,
                $order
            );

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
