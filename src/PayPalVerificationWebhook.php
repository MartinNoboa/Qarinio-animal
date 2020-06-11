<?php
include_once "util.php";
$_GET=limpia_entradas($_GET);
if(!isset($_GET["caso"])){
    $_GET["caso"]="";
}
if($_GET["caso"]=="donacion") {
    $response = json_decode(file_get_contents("php://input"));
    $noTrans = $response->resource->id;
    $monto = $response->resource->seller_receivable_breakdown->net_amount->value;
    $sql="UPDATE donacion SET monto='$monto' WHERE numeroTransaccion='$noTrans'";
    sqlqry($sql);
}
else if($_GET["caso"]=="cuotaRecuperacion") {

} else{
    http_response_code(404);
}