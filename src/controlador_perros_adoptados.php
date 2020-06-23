<?php
require_once "util.php";
if(!isset($_SESSION)){
    session_start();
}


$result = mostrarPerros();

if(http_response_code() == 200 && mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        //Des-comentar cuando se hayan agregado imagenes
        $img = "img/perros/".$row["idPerro"].".jpeg";
        //$img = "img/Mario.jpg";
        $name = $row["nombre"];
        $id = $row["idPerro"];
        include("_tarjetaPerroAdoptado.html");

    }
} else if(http_response_code() == 200) {

} else {
    include ('error.php');
}

?>
