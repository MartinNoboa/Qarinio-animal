<?php
function connectDb(){
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $dbname = "bd_qarinoanimal";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Checks connection
    if(!$con){
        var_dump(http_response_code(500));
        return false;
    }
    return $con;
}