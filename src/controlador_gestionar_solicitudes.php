<?php 
    include_once("util.php");

    limpia_entradas($_POST);

    $estado = $_POST["estado"]??"1";
    $nombre = $_POST["nombre"]??"";

    $result =  muestraTodasSolicitudes($estado, $nombre); 
    $tabla = "
    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium\">
        <thead>
            <tr>
                <th class=\"uk-width-small uk-text-secondary\">Adoptante</th>
                <th class=\"uk-width-small uk-text-secondary\">Perro</th>
                <th class=\"uk-text-center uk-text-secondary\">Formulario</th>
                <th class=\"uk-text-center uk-text-secondary\">Entrevista</th>
                <th class=\"uk-text-center uk-text-secondary\">Pago</th>
                <th class=\"uk-text-center uk-text-secondary uk-width-small\"></th>
                <th class=\"uk-text-center uk-text-secondary uk-width-small\"></th>
            </tr>
        </thead>
        <tbody>
    ";

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".$row['nombre']." " .$row['apellido'] ."</td>";
        $tabla .= "<td>".$row['Perro']."</td>";

        //----------------------------------------estado formulario

        if($row['Formulario'] == 5) { //completado
            $tabla .= "<td class=\" uk-text-center\">
            <div class = 'formulario' idSolicitud =" .$row["idSolicitud"].">
            <a class=\" uk-link-text\">
            <span class=\" uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Ya aprobaste este formulario!\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Formulario'] == 4) { //en proceso
            $tabla .= "<td class=\" uk-text-center\">
            <div class = ' formulario' idSolicitud =" .$row["idSolicitud"].">
            <a class=\" uk-link-text\">
            <span class=\" uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: No ha sido revisado este formulario.\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Formulario'] == 3) { //incompleto
            $tabla .= "<td class=\" uk-text-center\">
            <div class = \"formulario \" idSolicitud =".$row["idSolicitud"].">
            <a class=\" uk-link-text\">
            <span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Rechazaste este formulario\"></span>
            </a>
            </div>
            </td>";
        }


        //----------------------------------------estado entrevista


        if($row['Entrevista'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\">
            <div class = \"entrevista \" idSolicitud =".$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Aprobaste esta entrevista!\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Entrevista'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\">
            <div class = \"entrevista \" idSolicitud =".$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: Esta entrevista está en proceso.\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Entrevista'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\">
            <div class = \"entrevista \" idSolicitud =".$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Esta entrevista fue rechazada.\"></span>
            </a>
            </div>
            </td>";
        }

        //----------------------------------------estado pago


        if($row['Pago'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'pago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡El pago fue aprobado!\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Pago'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'pago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\" >
            <span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: El pago está en proceso.\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Pago'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'pago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: El pago fue rechazado\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Pago'] == 9) { 
            //en espera
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'pago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: warning\" uk-tooltip=\"title: El pago está esperando aprobación\"></span>
            </a>
            </div>
            </td>";
        }
        
        $a = '';
        if($row['Pago'] == 5 && $row['Entrevista'] == 5 && $row['Formulario'] == 5){
            $a = '';
        }else{
            $a = 'disabled';
        }
        
        $aprobada = '';
        if ($row['aprobada'] != NULL){
            $aprobada = 'disabled';
        }
        
        $tabla .= "<td>
        <button type='submit' name='apruebaSolicitud'  class='apruebaSolicitud uk-button-primary uk-button-small uk-button uk-border-rounded uk-align-center' uk-tooltip='title: Aprobar solicitud' $aprobada $a idSolicitud = " . $row['idSolicitud'] . ">
        <span uk-icon='icon: check'></span>
        </button>
        </td>";
        $tabla .= "<td>
        <button type='submit' name='rechazaSolicitud'  class='rechazaSolicitud uk-button-danger uk-button-small uk-button uk-border-rounded uk-align-center' uk-tooltip='title: Rechazar solicitud' $aprobada idSolicitud = " . $row['idSolicitud']. "><span uk-icon='icon: ban'></span></button>
        </td>";
        $tabla .= "</tr>";
        
    }
    
    mysqli_free_result($result); //Liberar la memoria
    $tabla .= "</tbody></table>";
    echo $tabla;

?>

    