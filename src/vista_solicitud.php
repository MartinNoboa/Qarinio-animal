<?php
    include_once("util.php");


    $idSolicitud = limpia_entrada($_POST['idSolicitud']);
    
?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded uk-width-large">
        <div class="uk-modal-title">
                <h1>Formulario</h1>
        </div>
        <div class="uk-modal-body">
            <form  id="formulario" class="uk-form-horizontal uk-margin-large">
                <div class="uk-align-right">
                <?php
                    $result = getFormulario($idSolicitud);
                    $ans = "<div class = \"uk-container\">";
                    $cont = true;
                    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                        if ($cont){
                            $ans .= "<h3>". $row["usuario"]. " - ". $row["perro"] . "</h3>";
                            $cont = false;
                        }
                        $ans .= "<h5>" .$row["n"] ." ". $row["pregunta"] ."</h5>";
                        $ans .= "<p>" . $row["respuesta"] ."</p>";
                        $ans .= "<hr>";
                    }

                    $ans .= "</div>";
                    echo $ans;
                ?>
                    <input class="uk-button uk-button-default uk-modal-close uk-border-rounded" type="button" value="Cancelar"></input>
                    <input class="uk-button uk-button-primary uk-border-rounded" id="btn-editar-preguntas" type="button" value="Guardar"></input>
                </div>
            </form>
        </div>
    </div>
