<?php
    require_once 'util.php';
    session_start();

    if(checkPriv("editar-faq")):
        $link = limpia_entrada($_POST["link"]);
        echo setLink($link);
?>


<?php
    http_response_code(200);
else:
    http_response_code(404);
    header("location:error");
endif;
 ?>