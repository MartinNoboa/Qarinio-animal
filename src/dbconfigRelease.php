<?php
function connectDb(){
    $servername = 'mysql1008.mochahost.com';
    $username = "dawbdorg_animal";
    $password = "animal";
    $dbname = "dawbdorg_animal";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Checks connection
    if(!$con){
        http_response_code(500);
        return false;
    }
    return $con;
}
