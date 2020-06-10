<?php
include_once "util.php";
$_POST=limpia_entradas($_POST);
$_GET=limpia_entradas($_GET);
if(!isset($_GET["id"])){
    $_GET["id"]=0;
}
if((int)$_GET["id"]==1){
    if(isset($_POST["oId"])){
        $orderId = $_POST['oId'];
        $userId = $_SESSION["id"]??null;
        $dml = "INSERT INTO donacion (numeroTransaccion, idUsuario) VALUES (?, ?)";
        insertIntoDb($dml, $orderId, $userId);
    }
} else {
    $response = json_decode(file_get_contents("php://input"));
    print_r($response->resource->amount->value);
    echo "<br>";
    print_r($response->resource->seller_receivable_breakdown->paypal_fee->value);
    echo "<br>";
    print_r($response->resource->seller_receivable_breakdown->net_amount->value);
    echo "<br>";
    print_r($response->resource->id);
}

?>