<?php
    require_once 'util.php';
    session_start();

    if(checkPriv("editar-faq")):
        $cuota = limpia_entrada($_POST["cuota"]);
        echo setCuota();
?>


<?php
    http_response_code(200);
else:
    http_response_code(404);
    header("location:error");
endif;
 ?>
