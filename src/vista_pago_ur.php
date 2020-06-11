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
                   $arr = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $metodo = $arr['metodo'];
                    $estado = $arr['estado'];

                    $cantChange = ($estado=="Aprobado"||($estado=="En espera"&&$metodo=="Paypal"));

                    $ans = "
                    <div class = 'uk-container'>
                    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium \">
                    <thead>
                        <tr>
                            <th class=\"uk-width-small uk-text-secondary\">Adeudo 
                              <span  uk-tooltip = \"title : Este es un pago de recuperación para poder seguir rescatando y cuidando perros en situaciones de riesgo.; pos :top-left\" uk-icon=\"icon:question; ratio: 0.8\"></span>
                            </th>
                            <th class=\"uk-width-small uk-text-secondary\">Metodo de Pago</th>
                            <th class=\"uk-width-small uk-text-secondary\">Estado</th>
                            </tr>
                    </thead>
                    <tbody>";
                

                        $ans .= "<tr>";
                        $ans .= "<td>$".  getCuota() ."</td>";
                        $ans .= "<td>
                            <select class=\"uk-select uk-border-rounded\" id = \"metodoPago\" name = \"metodoPago\" required ". ($cantChange?"disabled":"") .">";


                        $ans .= "<option ". ($metodo==null?"selected":"") ." hidden value='' >No ha seleccionado un método de pago.</option>
                                 <option ". ($metodo=="Efectivo"?"selected":"") ." value='Efectivo'>Efectivo</option>
                                 <option ". ($metodo=="Paypal"?"selected":"") ." value='Paypal'>Paypal</option>
                                 <option ". ($metodo=="Transferencia"?"selected":"") ." value='Transferencia'>Transferencia</option>";

                        $ans .= " </select>";
                        
                        $ans .= "<td>".$estado."</td>";
                        
                        $ans .= "</tr>";


                    mysqli_free_result($result); //Liberar la memoria
                    $ans .= "</tbody></table></div>";
                    echo $ans;


                   $instruccionesPago="<br>";
                   if($estado!=5){
                       switch ($metodo){
                           case "Efectivo":
                           case "Transferencia":
                               $instruccionesPago.="
                                        <div><h4 class='uk-text-center'>Alguien se pondrá en contacto contigo para completar el pago.</h4></div>
                                    ";
                               break;
                           case "Paypal":
                               if(!($estado=="Aprobado"||$estado=="En espera")){
                                   $instruccionesPago.="
                                        <div id='paypal-button-container-cuota' class='uk-align-center uk-text-center'></div>
                                        <input id='paypal-cuota-rec' type='number' value='". getCuota() ."' hidden readonly></input>
                                    ";
                               }
                               break;
                           default:
                               $instruccionesPago="";
                               break;
                       }
                   }

                    echo $instruccionesPago;

                    ?>
                    <div class="uk-child-width-expand@s uk-text-center uk-margin-top" uk-grid>
                        <div>
                            <input class="uk-button uk-button-primary uk-border-rounded " type="button"  value = "Actualizar método de pago" id = "actualizarMetodo"></input>
                        </div>
                    </div>
                
                    <input id = "idSolicitudActivaMetodoPago" type = "number" value = <?= $idSolicitud ?> hidden readonly></input>

            </form>
        </div>
    </div>
</div>
