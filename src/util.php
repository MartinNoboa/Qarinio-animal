<?php

include_once("../loginsAdmin/dbconfig.php");

function limpia_entrada($variable) {
    return $variable = htmlspecialchars($variable);
}
function limpia_entradas($arr){
    foreach($arr as &$key){
        $key = limpia_entrada($key);
    }
    return $arr;
}

function closeDb($mysqli){
    mysqli_close($mysqli);
}
function check($inp, $ind){
    if(isset($inp[$ind])){
        return limpia_entrada($inp[$ind]);
    } else{
        return false;
    }
}

function verificaCampos($arr, $camposRequeridos){
    foreach ($camposRequeridos as $campo){
        if(!isset($arr[$campo]) || $arr[$campo]==""){
            return false;
        }
    }
    return true;
}

//Función que conecta a la bd, realiza un query y vuelve a cerrar la bd. Recibe el SQL del query y regresa un objeto mysqli result
function sqlqry($qry){
    $con = connectDb();
    if(!$con){
        return false;
    }
    $result = mysqli_query($con, $qry);
    closeDb($con);
    return $result;
}

//Función para simplificar la inserción correcta a la bd. Recibe el código SQL donde los valores q insertar se representan con '?'
// E.g. INSERT INTO frutas (nombre, familia, precio) VALUES (?,?,?)
// Los valores se pasan como argumentos, deben ser correspondientes al numero de '?'. Se puede usar un arreglo como parámetro precedido de '...'
//E.g. insertIntoDb($sql, $nom, $fam, $precio)   insertIntDb($sql, ...$arrayWithValues)
//Regresa en indice del elemento insertado
function insertIntoDb($dml, ...$args){
    $conDb = connectDb();
    $types='';
    //Verifica los tipos de variable de los argumentos y termina el proceso si no son int, double, string o BLOB
    foreach ($args as $arg){
        $types.=substr(gettype($arg),0,1);
        if(preg_match('/[^idsb]/', $types)){
            die("Invalid argument, only Int, double, string and BLOB accepted");
        }
    }
    if ( !($statement = $conDb->prepare($dml)) ) {
        die("Error: (" . $conDb->errno . ") " . $conDb->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param($types, ...$args)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    //Executar la consulta
    if (!$statement->execute()) {
        die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    $id = $conDb->insert_id;
    closeDb($conDb);
    return $id;
}

function modifyDb($dml){
    $conDb = connectDb();

    $conDb->query($dml);
    $res=mysqli_affected_rows($conDb);

    closeDb($conDb);
    return $res;
}

function getCuota(){
    $sql= "SELECT * FROM cuotaDeRecuperacion";
    return mysqli_fetch_array(sqlqry($sql))[0];
}

function recuperarUsuarios(){
    $sql = "SELECT u.nombre,u.nombre,r.rol from usuario u, rol r, usuario_rol ur WHERE u.idUsuario=ur.idUsuario AND r.idRol=ur.idRol";
    return sqlqry($sql);
}

function autenticar($email, $password){
    //Recupera unicamente el password del usuario para poder verificarlo
    $passQuery = " 	SELECT contrasenia as passHash
					FROM 	usuario
					WHERE 	email='$email'";

    $passHash = sqlqry($passQuery)->fetch_object();

    if($passHash){
        $passHash=$passHash->passHash;
    } else{
        $passHash="";
    }

     //asigna los permisos del usuario a la sesión
    if (password_verify($password, $passHash)) {
        //Asigna los permisos del usuario
        setPermisos($email);

        return 1;
    } else{return 0;}
}

function setPermisos($email){
    $sql = "
        SELECT  u.idUsuario as id, u.nombre as nom, u.apellido ap, u.email em, p.privilegio as priv
        FROM usuario u, usuario_rol ur, rol r, privilegio_rol pr, privilegios p
        WHERE u.email='$email'
        AND u.idUsuario=ur.idUsuario
        AND ur.idRol=r.idRol
        AND r.idRol=pr.idRol
        AND pr.idPrivilegio=p.idPrivilegio
    ";
    $result = sqlqry($sql);

    $_SESSION['privilegios'] = [];

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        //asigna permisos
        $_SESSION['privilegios'][$row["priv"]] = 1;
        $_SESSION["nombre"] = $row["nom"];
        $_SESSION["apellido"] = $row["ap"];
        $_SESSION["id"] = $row["id"];
        $_SESSION["email"] = $row["em"];
    }
}

function checkPriv($priv){
    return isset($_SESSION["privilegios"]) && isset($_SESSION["privilegios"][$priv]) && $_SESSION["privilegios"][$priv]===1 ;
}

function cuentaExistente($email){
    $q = "  SELECT u.email
            FROM usuario as u
            WHERE email='$email'";
    return sqlqry($q)->num_rows>=1;
}

function cambiarContra($uid, $contrasenia){
    $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
    $dml = "UPDATE usuario u, cambio_contrasenia uc
            SET u.Contrasenia='$contrasenia', uc.usada=true
            WHERE uc.uid='$uid'
            AND u.idUsuario=uc.idUsuario
            AND uc.usada=false";
    return modifyDb($dml);
}

function crearCuenta($nombre, $apellido, $email, $telefono, $callePrincipal, $calleSecundaria, $numeroExterior, $numeroInterior, $cp, $colonia, $ciudad, $estado, $fechaNacimiento, $contrasenia, $rol){
    //Busca el email en la base de datos, si este existe, detiene la función
    if(cuentaExistente($email)){
        die("Error: Ya existe un usuario registrado con el correo ". $email);
    }

    //convierte la contraseña a un hash con las medidas de seguridad default actuales (esto cambia con el tiempo)
    $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
    //SQL para insertar un usuario
    $dml = "INSERT INTO usuario (nombre, apellido, email, telefono, callePrincipal, calleSecundaria, numeroExterior, numeroInterior, CodigoPostal, colonia, ciudad, estado, fechaNacimiento, contrasenia)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    //Usa una función para correr el código SQL de manera segura. Regresa el id del registro insertado
    $uId= insertIntoDb($dml, $nombre, $apellido, $email, $telefono, $callePrincipal, $calleSecundaria, $numeroExterior, $numeroInterior, $cp, $colonia, $ciudad, $estado, $fechaNacimiento, $contrasenia);
    //Recupera el id de el rol a asignar
    $rId = mysqli_fetch_object(sqlqry("SELECT idRol FROM `rol` WHERE rol='$rol'"))->idRol;
    //SQL para asignar rol a usuario
    $dml = "INSERT INTO usuario_rol (idUsuario, idRol) VALUES (?,?)";
    //Usa la función de insertar para agregar rol
    insertIntoDb($dml, $uId, $rId);

    $uniqId = insertUid("confirm_email", $uId);
    include_once("mail.php");
    send_email_verif($email, $nombre." ".$apellido, $uniqId);

    return 1;
}



function filterDogs($busq, $minA, $maxA, $male, $female, $peq, $med, $gra, $raz, $pers, $cond, $estado, $sort, $order){
    if($maxA==144){
        $maxA=9999;
    }

    $sql = "
        select
            p.idPerro,
            p.nombre,
            fechaLLegada,
            TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLLegada, INTERVAL -edadEstimadaLLegada MONTH), CURDATE()) as edad
        FROM perros as p,estado_perro as e,estado, caracteristicas c
        WHERE p.idPerro=e.idPerro
        AND e.idEstado=estado.idEstado
        AND c.idPerro=p.idPerro";

    if(checkPriv("editar-perro")){
        $sql.= " AND estado.nombre='$estado'";
    } else{
        $sql.= " AND estado.nombre='Disponible'";
    }


    $female = ($female=="true");
    $male = ($male=="true");
    $peq = ($peq=="true");
    $med = ($med=="true");
    $gra= ($gra=="true");

    if($male XOR $female){
        if($male AND !$female){
            $sql.= " AND sexo='macho'";
        } else {
            $sql .= " AND sexo='hembra'";
        }
    }

    if(($peq XOR $med XOR $gra) AND !($peq AND $med AND $gra)){
        $sql.=" AND (";
        if($peq){
            $sql.="p.tamanio='Pequeño'";
            if($med){
                $sql.=" OR ";
            }
        }
        if($med){
            $sql.="p.tamanio='Mediano'";
            if($gra){
                $sql.=" OR ";
            }
        }
        if($gra){
            $sql.="p.tamanio='Grande'";
        }
        $sql.=")";
    }

    if($cond!=0){
        $sql.=" AND idCondicion=$cond";
    }
    if($pers!=0){
        $sql.=" AND idPersonalidad=$pers";
    }
    if($raz!=0){
        $sql.=" AND idRaza=$raz";
    }

    $sql.=" AND p.nombre LIKE '%$busq%'";

    $sql.=" HAVING Edad BETWEEN " . $minA . " AND " . $maxA;

    switch($sort){
        case "name":
            $sql.=" ORDER BY nombre";
            break;
        case "timeIn":
            $sql.=" ORDER BY fechaLlegada";
            break;
        case "age":
            $sql.=" ORDER BY edad";
            break;
        default:
            $sort="";
            break;
    }
    if($sort!="" AND $order){
        $sql.=" ".$order;
    }
    //print_r($sql);
    return sqlqry($sql);
}




    //función para eliminar una perro
    //@param id_perro: id del perro que se va a eliminar
function eliminar_perro($id_perro) {
    $sql="UPDATE estado_perro SET idEstado=(SELECT idEstado from estado where nombre='Eliminado') WHERE idPerro=$id_perro";
    $res=modifyDb($sql);
    return $res;
  }

function editarPerro($idPerro,$nombre,$size,$edad,$sexo,$historia,$idCondicion,$idRaza,$idPersonalidad, $estado) {
    $sql = "UPDATE perros p, caracteristicas c, estado_perro e
            SET nombre='$nombre',
                tamanio='$size',
                edadEstimadaLLegada=TIMESTAMPDIFF(MONTH, DATE_ADD(CURDATE(), INTERVAL -$edad-1 MONTH), fechaLLegada),
                sexo='$sexo',
                historia='$historia',
                idCondicion=$idCondicion,
                idRaza=$idRaza,
                idPersonalidad=$idPersonalidad,
                idEstado=$estado
            WHERE p.idPerro=$idPerro
              AND p.idPerro=c.idPerro
              AND p.idPerro=e.idPerro";
    //echo $sql;
    return modifyDb($sql);
}





/*
*@param: valores del perro por agregar
*/
function agregarPerro($nombre,$size,$edad,$fechaLlegada,$sexo,$historia,$idCondicion,$idPersonalidad,$idRaza, $estado) {

    $success = false;

    $dml = "INSERT INTO perros (nombre, tamanio, edadEstimadaLlegada, fechaLlegada, sexo, historia)
            VALUES (?,?,?,?,?,?)";


    $dml1 = "INSERT INTO caracteristicas
            VALUES ((SELECT idPerro FROM perros ORDER BY idPerro DESC LIMIT 1), ?,?,?)";

    $dml2 = "INSERT INTO estado_perro VALUES ((SELECT idPerro FROM perros ORDER BY idPerro DESC LIMIT 1), ?)";


    $first = insertIntoDb($dml,$nombre,$size,$edad,$fechaLlegada,$sexo,$historia);
    if($first != 0){
        $sec = insertIntoDb($dml1 ,$idCondicion,$idPersonalidad,$idRaza);
        $third = insertIntoDb($dml2, $estado);
            if ($third != 0){
                $success = true;

            }
    }

    return $success;
}



function recuperarOpciones($id, $campo, $tabla){
    $sql = "SELECT $id, $campo FROM $tabla";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
    $option = $option."<option value=".$row[0].">".ucfirst($row[1])."</option>";    }

    return $option;
  }

function recuperarEstadosPerros($val, $selected){
    $sql = "SELECT $val, nombre FROM estado WHERE perro = 1";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
    $option = $option."<option value='".$row[0]."' ".($row[1]==$selected?"selected":"").">".ucfirst($row[1])."</option>";    }

    return $option;
  }

function recuperarOpcionesConSelect($id, $campo, $tabla, $selected){
    $sql = "SELECT $id, $campo FROM $tabla";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
        $option.= "<option value=". $row[0] . ($row[1]==$selected?" selected":"") . ">" . $row[1] . "</option>";
    }

    return $option;
}

function getDogInfoById($id){
    $sql = "
        SELECT
               p.nombre nombre,
               tamanio,
               TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLLegada, INTERVAL -edadEstimadaLLegada MONTH), CURDATE()) as edad,
               sexo,
               historia,
               condicion,
               med.descripcion,
               personalidad,
               pers.descripcion,
               raza,
               rz.descripcion,
               e.nombre estado
        FROM perros p, caracteristicas c, condiciones_medicas med, tipo_personalidad pers, tipo_raza rz, estado_perro ep, estado e
        WHERE p.idPerro=c.idPerro
        AND c.idCondicion=med.idCondicion
        AND c.idPersonalidad=pers.idPersonalidad
        AND c.idRaza=rz.idRaza
        AND p.idPerro=ep.idPerro
        AND ep.idEstado=e.idEstado
        AND p.idPerro=$id
        GROUP BY p.idPerro";

        $res = mysqli_fetch_array(sqlqry($sql));
        $m = $res["edad"];
        $a = ($m-$m%12)/12;
        $m = $m%12;
        $res["anios"] = $a;
        $res["meses"] = $m;
        return $res;
}


function sintaxisEdad($meses) {
    $m = $meses;
    $a = ($m-$m%12)/12;
    $m = $m%12;

    $age= $a.' años, '.$m.' meses';

    $age = '';
    if($a>0){
        $age= $a.' '.($a==1?'año':'años');
    }
    //El $a <= 3 se puede quitar, solo es preferencia para mostrar los meses solo para perros menores a 3 años
    if($m>0 AND $a<=3){
        if($a>0){
            $age.=', ';
        }
        $age .= $m.' '.($m==1?'mes':'meses');
    }
    return $age;
}

function muestraSolicitudes($id){
    $sql = "
    SELECT s.idSolicitud as 'idSolicitud', p.nombre as 'Perro', s.estadoFormulario as 'Formulario', s.estadoEntrevista as 'Entrevista', s.estadoPago as 'Pago'
FROM perros p, usuario u, solicitud s
WHERE u.idUsuario=s.idUsuario AND p.idPerro=s.idPerro AND u.idUsuario=$id AND s.activa";

    $tabla = "
    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium\">
        <thead>
            <tr>
                <th class=\"uk-width-small uk-text-secondary\">Perro</th>
                <th class=\"uk-text-center uk-text-secondary\">Formulario</th>
                <th class=\"uk-text-center uk-text-secondary\">Entrevista</th>
                <th class=\"uk-text-center uk-text-secondary\">Pago</th>
                <th class=\"uk-text-center uk-text-secondary uk-width-small\"></th>
            </tr>
        </thead>
        <tbody>
    ";

    $solicitudes = sqlqry($sql);
    while($row = mysqli_fetch_array($solicitudes, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".$row['Perro']."</td>";
        //------------------------------------------------------ Estado del formulario
       $icono="";
       $tooltip="";
       $color="";
       switch($row['Formulario']){
           case 5:
               $icono="check";
               $tooltip="¡Tu formulario fue aprobado!";
               $color="success";
               break;
           case 3:
               $icono="close";
               $tooltip="Tu formulario fue rechazado.";
               $color="danger";
               break;
           case 4:
           default:
               $icono="minus";
               $tooltip="No se ha revisado tu formulario todavía.";
               $color="warning";
               break;
       }

       $tabla .= "<td class=\" uk-text-center\">
            <div class = 'urformulario ' idSolicitud =".$row["idSolicitud"].">
            <a class='uk-link-text'>
            <span class='uk-text-center uk-text-".$color."' uk-icon='icon:". $icono ."' uk-tooltip='title:". $tooltip ."'></span>
            </a>
            </div>
            </td>";

        //------------------------------------------------------ Estado de la entrevista


        if($row['Entrevista'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\">
            <div class = \"urentrevista \" idSolicitud =".$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title:¡Ya realizaste tu entrevista!\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Entrevista'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\">
            <div class = \"urentrevista \" idSolicitud =".$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: No has realizado tu entrevista.\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Entrevista'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\">
            <div class = \"urentrevista \" idSolicitud =".$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title:Tu entrevista fue rechazada.\"></span>
            </a>
            </div>
            </td>";
        }

        //----------------------------------------estado pago


        if($row['Pago'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'urpago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Tu pago fue aprobado!\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Pago'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'urpago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\" >
            <span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: No has realizado tu pago.\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Pago'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'urpago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Tu pago fue rechazado\"></span>
            </a>
            </div>
            </td>";
        }
        elseif($row['Pago'] == 9) { //en proceso
            $tabla .= "<td class=\"uk-text-center\">
            <div class = 'urpago' idSolicitud =" .$row["idSolicitud"].">
            <a class=\"uk-link-text\">
            <span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: warning\" uk-tooltip=\"title: Tu pago está en proceso\"></span>
            </a>
            </div>
            </td>";
        }
        $tabla .= '<td ><button type="submit" name="btn-elimina-solicitud" id="'.$row['idSolicitud'].'" class="uk-button-danger uk-button-small uk-button uk-border-rounded uk-align-center" uk-tooltip="title: Cancelar solicitud" onclick="muestraAlert('.$row['idSolicitud'].')"><span uk-icon="icon: trash"></span></button></td>';
        $tabla .= "</tr>";
    }
    $tabla .= "</tbody></table>
            <hr class='uk-divider-icon'>
            <h3>Solicitudes finalizadas</h3>
            <table class='uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium'><thead>
            <tr>
                <th class='uk-width-small uk-text-secondary'>Perro</th>
                <th class='uk-text-center uk-text-secondary'>Estado del proceso de adopción</th>
            </tr>
            </thead><tbody>";

    $sql = "
    SELECT p.nombre as 'Perro', s.aprobada as 'apr'
    FROM perros p, usuario u, solicitud s
    WHERE u.idUsuario=s.idUsuario AND p.idPerro=s.idPerro AND u.idUsuario=$id AND s.aprobada IS NOT NULL";

    $solicitudes = sqlqry($sql);
    while($row = mysqli_fetch_array($solicitudes, MYSQLI_BOTH)){
        if($row['apr']) {
            $icono = "check";
            $tooltip = "¡Tu solicitud ha sido completada y aprobada!";
            $color = "success";
        } else {
            $icono="close";
            $tooltip="Tu solicitud ha sido completada pero fue rechazada.";
            $color="danger";
        }
        $tabla.="<tr>
                    <td>". $row['Perro'] ."</td>
                    <td class='uk-text-center'> <span class='uk-text-center uk-text-".$color."' uk-icon='icon: ".$icono."' uk-tooltip='title: ".$tooltip."'></span></td>
                </tr>";
    }
    $tabla.="</tbody></table>";


        return $tabla;
}

function muestraPreguntasFormulario() {
    $sql = "SELECT preguntas.idPregunta as 'id', preguntas.pregunta as 'pregunta', preguntas.tipo as 'tipo' FROM preguntas";
    $preguntas = sqlqry($sql);
    /*
    <div class="uk-margin">
        <label class="uk-form-label" for="pregunta">Texto de la pregunta:</label>
        <div class="uk-form-controls">
            <textarea class="uk-textarea uk-border-rounded" id="nombre" type="textarea" placeholder="Respuesta" value=""></textarea>
        </div>
    </div>
    */
    $output = "";
    while($row = mysqli_fetch_array($preguntas, MYSQLI_BOTH)) {
        $output .= "<div class=\"uk-margin\">";
        $output .= "<h5>".$row['id']. " - " .ucfirst($row['pregunta']) ."</h5>";
        $output .= "<div class=\"uk-form-controls\">";

        switch ($row['tipo']) {
            case 'radio':
                if($row['id'] == 7) {
                $output .= "<div class=\"uk-margin uk-grid-small uk-child-width-auto uk-grid\">";
                $output .= "<label><input type='radio' class=\"uk-radio\" name=\"".$row['id']."\" value=\"casa\"> Casa</label>";
                $output .= "<label><input type='radio' class=\"uk-radio\" name=\"".$row['id']."\" value=\"departamento\"> Departamento</label>";
                $output .= "</div>";
                }
                else {
                    $output .= "<div class=\"uk-margin uk-grid-small uk-child-width-auto uk-grid\">";
                    $output .= "<label><input type='radio' class=\"uk-radio\" name=\"".$row['id']."\" value=\"sí\"> Sí</label>";
                    $output .= "<label><input type='radio' class=\"uk-radio\" name=\"".$row['id']."\" value=\"no\"> No</label>";
                    $output .= "</div>";
                }
                break;
            case 'numeric':
                $output .= "<input type='number' min=0 class=\"uk-input uk-border-rounded\" id=\"".$row['id']."\">";
                break;
            default:
                $output .= "<textarea class=\"uk-textarea uk-border-rounded\" id=\"".$row['id']."\" type=\"textarea\" placeholder=\"Tu respuesta\" value=\"\"></textarea>";
                break;
        }

        $output .= "</div>";
        $output .= "</div>";
    }
    return $output;
}

function insertUid($type, $uId){
    do{
        $uniqId = md5(uniqid());
    }while(sqlqry("SELECT uid from $type where uid='$uniqId'")->num_rows>0);
    $dml = "INSERT INTO $type (uid, idUsuario) VALUES (?,?)";
    insertIntoDb($dml, $uniqId, $uId);
    return $uniqId;
}


function nuevaSolicitud ($idUsuario, $idPerro,$res1, $res2,$res3,$res4,$res5,$res6,$res7,$res8,$res9,$res10,$res11,$res12){
    //corregir bd foreign key constraint
    /*$sql = 'INSERT INTO solicitud (idUsuario, idPerro, estadoFormulario, estadoEntrevista, estadoPago)
            VALUES ($idUsuario, $idPerro, 3,3,3)';*/
    $sql1 = "CALL crearNuevaSolicitud($idUsuario,$idPerro,'$res1','$res2','$res3','$res4','$res5','$res6','$res7','$res8','$res9','$res10','$res11','$res12')";

    //print_r($sql1);


    return sqlqry($sql1);


}

function recuperarProximoId(){
    $query = "SELECT idPerro as id from perros ORDER BY idPerro DESC LIMIT 1";
    $result = sqlqry($query);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    if($row["id"] == 0)
        $num = 1;
    else
        $num = $row["id"] + 1;
    return $num;
}

function muestraTodasSolicitudes(){
    $sql = "SELECT u.nombre as 'nombre', u.apellido as 'apellido',s.idSolicitud as 'idSolicitud', p.nombre as 'Perro', s.estadoFormulario as 'Formulario',s.estadoEntrevista as         'Entrevista', s.estadoPago as 'Pago'
            FROM usuario as u,solicitud as s, perros as p
            WHERE u.idUsuario = s.idUsuario AND p.idPerro = s.idPerro";
    $result = sqlqry($sql);
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
        $tabla .= "<td>".$row['nombre']. $row['apellido'] ."</td>";
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
            <div class = ' formulario 'idSolicitud =" .$row["idSolicitud"].">
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
        elseif($row['Pago'] == 9) { //en espera
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
        
        $tabla .= "<td>
        <button type='submit' name='apruebaSolicitud'  class='apruebaSolicitud uk-button-primary uk-button-small uk-button uk-border-rounded uk-align-center' uk-tooltip='title: Aprobar solicitud' $a idSolicitud = " . $row['idSolicitud'] . ">
        <span uk-icon='icon: check'></span>
        </button>
        </td>";
        $tabla .= "<td>
        <button type='submit' name='rechazaSolicitud'  class='rechazaSolicitud uk-button-danger uk-button-small uk-button uk-border-rounded uk-align-center' uk-tooltip='title: Rechazar solicitud' idSolicitud = " . $row['idSolicitud']. "><span uk-icon='icon: ban'></span></button>
        </td>";
        $tabla .= "</tr>";
        
    }
    
    mysqli_free_result($result); //Liberar la memoria
    $tabla .= "</tbody></table>";
    return $tabla;

}

function getFormulario($id){
    $sql = "SELECT s.idSolicitud as 'id', p.idPregunta as 'n', p.pregunta as 'pregunta', r.respuesta as 'respuesta', pe.nombre as 'perro', u.nombre as 'usuario', u.apellido as 'apellido'
FROM preguntas as p, respuestas as r, solicitud as s, perros as pe , usuario as u
WHERE p.idPregunta = r.idPregunta AND $id = s.idSolicitud  AND r.idSolicitud = s.idSolicitud
AND s.idPerro = pe.idPerro
AND s.idUsuario = u.idUsuario";

    $result = sqlqry($sql);



    return $result;
}

function getPago($id){
    $sql = "SELECT u.nombre as 'adoptante', e.nombre as 'estado', s.metodoPago as 'metodo'
FROM solicitud as s, usuario as u, estado as e
WHERE s.idUsuario = u.idUsuario AND s.idSolicitud = $id AND s.estadoPago = e.idEstado";
    $result = sqlqry($sql);
    return $result;
}

function getEntrevista($id){
    $sql = "SELECT u.nombre as 'nombre', u.apellido as 'apellido', u.telefono as 'telf', e.nombre as 'estado'
FROM usuario as u, solicitud as s, estado as e
WHERE u.idUsuario = s.idUsuario AND s.idSolicitud = $id AND s.estadoEntrevista = e.idEstado";
    $result = sqlqry($sql);
    return $result;
}

function eliminarSolicitud($idSolicitud) {
    $sql1="
    UPDATE solicitud SET activa=false WHERE idSolicitud='$idSolicitud'
    ";
    $sql2="
    UPDATE estado_perro ep, solicitud s SET ep.idEstado=2 WHERE ep.idPerro=s.idPerro AND idSolicitud='$idSolicitud'
    ";
    return modifyDb($sql1) && modifyDb($sql2);
  }

function aceptarSolicitud($idSolicitud) {
    $sql="
    UPDATE solicitudes SET aprobada = 1, activa = 0 WHERE idSolicitud = $idSolicitud 
    ";
    $sql1="
    UPDATE estado_perro SET idEstado = 1 WHERE idPerro = (SELECT idPerro FROM solicitud as s WHERE s.idSolicitud = $idSolicitud)
    ";
    $res=modifyDb($sql);
    $res1=modifyDb($sql1);
    return $res && $res1;
  }

function getUserInfoById($id){
      $sql = "
        SELECT nombre,
        apellido,
        email,
        telefono,
        callePrincipal,
        calleSecundaria,
        NumeroExterior,
        NumeroInterior,
        CodigoPostal,
        Colonia,
        Ciudad,
        Estado,
        fechaNacimiento
        FROM usuario
        WHERE idUsuario=".$id;

          $res = mysqli_fetch_array(sqlqry($sql));
          return $res;
  }

function editarPerfil($id, $nombre,$apellido,$telefono,$callePrincipal,$calleSecundaria,$numeroExterior,$numeroInterior,$codigoPostal,$colonia,$ciudad,$estado,$fechaNacimiento) {
    $sql = "
    UPDATE usuario u SET nombre='".$nombre."', apellido='".$apellido."',
    telefono='".$telefono."', callePrincipal='".$callePrincipal."', calleSecundaria='".$calleSecundaria."',
    NumeroExterior='".$numeroExterior."', NumeroInterior='".$numeroInterior."', CodigoPostal='".$codigoPostal."',
    Colonia='".$colonia."', Ciudad='".$ciudad."', Estado='".$estado."', fechaNacimiento='".$fechaNacimiento."'
    WHERE u.idUsuario='".$id."'";
    return modifyDb($sql);
}

function actualizarEstadoFormulario($id,$estado){
    $sql = "UPDATE solicitud SET estadoFormulario = $estado WHERE idSolicitud = $id";
    $result = modifyDb($sql);
    $idperro = sqlqry("SELECT p.idPerro FROM perros  as  p, solicitud as s WHERE p.idPerro=s.idPerro AND s.idSolicitud=$id");
    $row = mysqli_fetch_array($idperro);

    $sql2 = $estado==3 ? "UPDATE estado_perro SET idEstado=2 WHERE idPerro=$row[0]":"UPDATE estado_perro SET idEstado=6 WHERE idPerro=$row[0]";

    $result2 = sqlqry($sql2);

    return $result + $result2;

}

function actualizarEstadoEntrevista($id,$estado){
    $sql = "UPDATE solicitud SET estadoEntrevista = $estado WHERE idSolicitud = $id";
    $result = modifyDb($sql);
    return $result;
}

function actualizarEstadoPago($id,$estado){
    $sql = "UPDATE solicitud SET estadoPago = $estado, fechaPago = now() WHERE idSolicitud = $id";
    //print_r($sql);
    $result = modifyDb($sql);
    return $result;
}

function actualizarMetodoPago($id, $metodo){
    $sql = "UPDATE solicitud SET metodoPago='$metodo', estadoPago=9 WHERE idSolicitud=$id and estadoPago!=5";
    return sqlqry($sql);
}

function agregarOperador($email){
    $sql1="select u.idUsuario id from  usuario u, usuario_rol ur, rol r
            where email='$email'
              and u.idUsuario=ur.idUsuario
              and ur.idRol=r.idRol
            and r.rol='registrado'";
    $idU=sqlqry($sql1);
    if($idU->num_rows>0){
        $idU=mysqli_fetch_array($idU)["id"];
        $sql2="UPDATE usuario_rol
                SET idRol = 2
                WHERE idUsuario='$idU'";
        return modifyDb($sql2);
    }
    else {
        return "2";
    }
}

function muestraOperadores() {
    $sql = "SELECT u.idUsuario as 'id', u.nombre as 'nombre', u.apellido as 'apellido', u.email as 'email'
            FROM usuario as u, usuario_rol as ur
            WHERE u.idUsuario=ur.IdUsuario AND idRol=2";
    $result = sqlqry($sql);
    $tabla = "
    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium\">
        <thead>
            <tr>
                <th class=\"uk-width-small uk-text-secondary\">Nombre</th>
                <th class=\"uk-width-small uk-text-secondary\">Correo Electrónico</th>
                <th class=\"uk-text-secondary uk-table-shrink\"></th>
            </tr>
        </thead>
        <tbody>
    ";
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".$row['nombre']. " ". $row['apellido'] ."</td>";
        $tabla .= "<td>".$row['email']."</td>";
        $tabla .= '<td><button type="submit" name="btn-elimina-solicitud" id="'.$row['id'].'" class="uk-button-danger uk-button-small uk-button uk-border-rounded" uk-tooltip="title: Eliminar operador" onclick="muestraAlertOperador('.$row['id'].')"><span uk-icon="icon: trash"></span></button></td>';
        $tabla .= "</tr>";
    }
    mysqli_free_result($result); //Liberar la memoria
    $tabla .= "</tbody></table>";
    return $tabla;

}

function eliminaOperador($id) {
    $sql1="UPDATE usuario_rol ur, rol r
    SET ur.idRol = 3
    WHERE ur.idUsuario=$id
    AND r.rol='operador'";
    return modifyDb($sql1);
}
