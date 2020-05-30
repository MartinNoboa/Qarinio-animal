<?php
    include_once("util.php");


    $idSolicitud = limpia_entrada($_POST['idSolicitud']);
    
?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1 class = "uk-text-center">Estado de Entrevista</h1>
        </div>
        <div class="uk-modal-body">
            <form  id="pago" class="uk-form-horizontal uk-margin-large">
                   <?php
                    
                    $result = getEntrevista($idSolicitud);
                    $ans = "
                    <div class = 'uk-container'>
                    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium \">
                    <thead>
                        <tr>
                            <th class=\"uk-width-small uk-text-secondary\">Adoptante</th>
                            <th class=\"uk-width-small uk-text-secondary\">Estado</th>
                            <th class=\"uk-width-small uk-text-secondary\">Comentario</th>
                            </tr>
                    </thead>
                    <tbody>";
                
                
                    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                        $ans .= "<tr>";
                        $ans .= "<td>".$row['nombre']. " " .$row['apellido'] . "</td>";
                        $ans .= "<td>".$row['estado']."</td>";
                        
                        if ($row["estado"] == 'Aprobado'){
                            $ans .= "<td>¡Ya realizaste tu entrevista y fue aprobada!</td>";
                            
                        }elseif ($row["estado"] == 'En proceso'){
                            $ans .= "<td>Todavia no has realizado tu entrevista. Alguien se pondrá en contacto contigo lo mas pronto posible.</td>";
                            
                        }elseif ($row["estado"] == 'Rechazado'){
                            $ans .= "<td>Desafortunadamente, no pasaste la entrevista. Si deseas adoptar al perro, vuelve a inciar el proceso de adopción.</td>";
                            
                        }
                        
                        
                        $ans .= "</tr>";
    
   
                    }
                    mysqli_free_result($result); //Liberar la memoria
                    $ans .= "</tbody></table></div>";
                    echo $ans;
                    
                    ?>
                    
                
                    <input id = "idSolicitudActivaEntrevista" type = "number" value = <?= $idSolicitud ?> hidden readonly></input>

            </form>
        </div>
    </div>
</div>

