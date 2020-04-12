<?php
function limpia_entrada($variable) {
    return $variable = htmlspecialchars($variable);
}
function connectDb(){
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $dbname = "qarinioAnimal";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Checks connection
    if(!$con){
        die("Estamos trabajando para arreglar este problema! " . mysqli_connect_error());
    }

    return $con;
}
function closeDb($mysqli){
    mysqli_close($mysqli);
}

