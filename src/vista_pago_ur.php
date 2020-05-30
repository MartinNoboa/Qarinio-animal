<?php
    include_once("util.php");


    $idSolicitud = limpia_entrada($_POST['idSolicitud']);
    
?>
<div class="uk-modal-dialog uk-modal-body uk-border-rounded">
        <div class="uk-modal-title">
                <h1 class = "uk-text-center">Estado de Pago</h1>
        </div>
        <div class="uk-modal-body">
            <form  id="pago" class="uk-form-horizontal uk-margin-large">
                   <?php
                    
                    $result = getPago($idSolicitud);
                    $noCambio = true;
                    $ans = "
                    <div class = 'uk-container'>
                    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium \">
                    <thead>
                        <tr>
                            <th class=\"uk-width-small uk-text-secondary\">Adoptante</th>
                            <th class=\"uk-width-small uk-text-secondary\">Metodo de Pago</th>
                            <th class=\"uk-width-small uk-text-secondary\">Estado</th>
                            </tr>
                    </thead>
                    <tbody>";
                
                
                    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                        $ans .= "<tr>";
                        $ans .= "<td>".$row['adoptante']."</td>";
                        
                        if ($row['metodo'] == null){
                            $ans .= "<td> El adoptante no ha seleccionado su método de pago.</td>";
                        }elseif ($row["metodo"] != "Efectivo"){
                            $ans .= "<td uk-tooltip = 'title: El adoptante no ha realizado su pago.'>".$row['metodo']."</td>";
                        }else{
                            //metodo de pago es efectivo
                            $ans .= "<td>".$row['metodo']."</td>";
                            $noCambio = false;
                        }
                        
                        $ans .= "<td>".$row['estado']."</td>";
                        
                        $ans .= "</tr>";
    
   
                    }
                    mysqli_free_result($result); //Liberar la memoria
                    $ans .= "</tbody></table></div>";
                    echo $ans;
                    
                    ?>
                    
                    
                
                    <input id = "idSolicitudActivaPago" type = "number" value = <?= $idSolicitud ?> hidden readonly></input>

            </form>
        </div>
    </div>
</div>

