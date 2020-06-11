<?php
    include_once("util.php");


    $idSolicitud = limpia_entrada($_POST['idSolicitud']);
    //print_r($idSolicitud);

?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1 class = "uk-text-center">Estado de Entrevista</h1>
        </div>
        <div class="uk-modal-body">
            <form  id="entrevista" class="uk-form-horizontal uk-margin-large">
                   <?php

                    $result = getEntrevista($idSolicitud);
                    $ans = "
                    <div class = 'uk-container'>
                    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium \">
                    <thead>
                        <tr>
                            <th class=\"uk-width-small uk-text-secondary\">Adoptante</th>
                            <th class=\"uk-width-small uk-text-secondary\">Número de teléfono</th>
                            <th class=\"uk-width-small uk-text-secondary\">Estado</th>
                            </tr>
                    </thead>
                    <tbody>";


                    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                        $ans .= "<tr>";
                        $ans .= "<td>".$row['nombre']. " " .$row['apellido'] . "</td>";
                        $ans .= "<td>".$row['telf']."</td>";
                        $ans .= "<td>".$row['estado']."</td>";

                        $ans .= "</tr>";


                    }
                    mysqli_free_result($result); //Liberar la memoria
                    $ans .= "</tbody></table></div>";
                    echo $ans;

                    ?>

                    <div class="uk-child-width-expand@s uk-text-center uk-margin-top" uk-grid>
                        <div>
                            <input class="uk-button uk-button-primary uk-border-rounded uk-width-1-1" type="button"  value = "Aprobar entrevista" id = "entrevistaSi"></input>
                        </div>
                        <div>
                            <input class="uk-button uk-button-danger uk-modal-close uk-border-rounded uk-width-1-1" type="button" id = "entrevistaNo" value = "Rechazar entrevista"></input>
                        </div>
                    </div>


                    <input id = "idSolicitudActivaEntrevista" type = "number" value = <?= $idSolicitud ?> hidden readonly></input>

            </form>
        </div>
    </div>
</div>
