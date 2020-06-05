<?php
if(!empty($_POST)){
    print_r($_POST);
} else{
    print_r(json_decode(file_get_contents("php://input"), true)["resource"]["amount"]["value"]);
    echo "<br>";
    print_r(json_decode(file_get_contents("php://input"), true)["resource"]["id"]);
}
?>