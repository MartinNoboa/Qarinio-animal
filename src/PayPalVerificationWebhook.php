<?php
include_once "util.php";
include_once "../loginsAdmin/paypalVer.php";

$_GET=limpia_entradas($_GET);
if(!isset($_GET["uid"])){
    $_GET["uid"]="";
}
if(comparePaypalUid($_GET["uid"])) {
    $response = json_decode(file_get_contents("php://input"));
    $noTrans = $response->resource->id;
    $monto = $response->resource->seller_receivable_breakdown->net_amount->value;
    $sql="UPDATE donacion SET monto='$monto' WHERE numeroTransaccion='$noTrans'";

    if(!modifyDb($sql)){
        $sql="UPDATE solicitud SET estadoPago=5 WHERE noTransaccion='$noTrans' AND estadoPago=9";
        modifyDb($sql);
    }

} else{
    http_response_code(404);
}