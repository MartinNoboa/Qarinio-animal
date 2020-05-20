<?php
include_once  "util.php";
if (isset($_GET["id"])){
    $uid = $_GET["id"];
    session_start();
    $unverified = sqlqry(
    "SELECT uid
            FROM confirm_email ce, usuario_rol ur, rol r
            WHERE uid='$uid'
            AND ce.idUsuario = ur.idUsuario
            AND ur.idRol = r.idRol
            AND r.rol='registrado-no-verificado'"
    )->num_rows;
    if($unverified > 0){
        $uid = limpia_entrada($_GET["id"]);
        $sql = "UPDATE  confirm_email e, usuario u, usuario_rol ur
                SET  ur.idRol=(SELECT idRol from rol where rol = 'registrado')
                WHERE e.uid='$uid'
                AND e.idUsuario = u.idUsuario
                AND u.idUsuario = ur.idUsuario";
        modifyDb($sql);

        $_SESSION["mensaje"] = "Su correo ha sido verificado exitosamente";
        header("location:index");
    }else {
        $_SESSION["error"] = "Hubo un error en la verificación de la cuenta, por favor revisa el enlace";
        header("location:index");
    }
}
else{
    header("location:404.html");
}
