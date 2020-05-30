<?php
    include_once("util.php");


    $idSolicitud = $_POST['idSolicitud'];
    
?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1 class = "uk-text-center">Formulario</h1>
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
                            $ans .= "<h1>". $row["usuario"]. " " . $row["apellido"] . " - ". $row["perro"] . "</h1>";
                            $cont = false;
                        }
                        $ans .= "<h4>" .$row["n"] ." ". $row["pregunta"] ."</h4>";
                        $ans .= "<p class = \" uk-text-bold\">" . $row["respuesta"] ."</p>";
                        $ans .= "<hr>";
                    }

                    $ans .= "</div>";
                    echo $ans;
                    ?>
                    
                    <div class="uk-child-width-expand@s uk-text-center uk-margin-top" uk-grid>
                        <div>
                            <input class="uk-button uk-button-primary uk-border-rounded uk-width-1-1" type="button"  value = "Aprobar formulario" id = "aprobar"></input>
                        </div>
                        <div>
                            <input class="uk-button uk-button-danger uk-modal-close uk-border-rounded uk-width-1-1" type="button" id = "rechazar" value = "Rechazar formulario"></input>
                        </div>
                    </div>

                </div>
                    <input id = "idSolicitudActiva" type = "number" value = <?= $idSolicitud ?>  readonly></input>

            </form>
        </div>
    </div>
</div>

