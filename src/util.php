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
        SELECT  u.idUsuario as id, u.nombre as nom, p.privilegio as priv
        FROM usuario u, usuario_rol ur, rol r, privilegio_rol pr, privilegios p
        WHERE u.email='$email'
        AND u.idUsuario=ur.idUsuario
        AND ur.idRol=r.idRol
        AND r.idRol=pr.idRol
        AND pr.idPrivilegio=p.idPrivilegio
    ";
    $result = sqlqry($sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        //asigna permisos
        $_SESSION['privilegios'][$row["priv"]] = 1;
        $_SESSION["nombre"] = $row["nom"];
        $_SESSION["id"] = $row["id"];
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
            AND u.idUsuario=uc.idUsuario";
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



function filterDogs($minA, $maxA, $male, $female, $sort, $order){
    if($maxA==144){
        $maxA=9999;
    }

    $sql = "
        select
            p.idPerro,
            p.nombre,
            fechaLLegada,
            TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLLegada, INTERVAL -edadEstimadaLLegada MONTH), CURDATE()) as edad
        FROM perros as p,estado_perro as e,estado
        WHERE p.idPerro=e.idPerro
        AND e.idEstado=estado.idEstado
        AND estado.nombre='disponible'";


    $female = ($female=="true");
    $male = ($male=="true");

    if($male XOR $female){
        if($male AND !$female){
            $sql.= " AND sexo='macho'";
        } else {
            $sql .= " AND sexo='hembra'";
        }
    }

    $sql.=" HAVING Edad BETWEEN " . $minA . " AND " . $maxA;

    switch($sort){
        case "name":
            $sql.=" ORDER BY nombre";
            break;
        case "timeIn":
            $sql.=" ORDER BY fechaLlegada";
            break;
        default:
            break;

    }
    if($sort!="" AND $order){
        $sql.=" ".$order;
    }
    //echo $sql;
    return sqlqry($sql);
}




    //función para eliminar una perro
    //@param id_perro: id del perro que se va a eliminar
function eliminar_perro($id_perro) {
    $sql='UPDATE estado_perro SET idEstado=6 WHERE idPerro='.$id_perro;
    $res=modifyDb($sql);
    return $res;
  }

function editarPerro($idPerro,$nombre,$size,$edad,$sexo,$historia,$idCondicion,$idRaza,$idPersonalidad) {
    $sql = "UPDATE perros p, caracteristicas c
            SET nombre='$nombre', tamanio='$size', edadEstimadaLLegada=TIMESTAMPDIFF(MONTH, DATE_ADD(CURDATE(), INTERVAL -$edad MONTH), fechaLLegada),
            sexo='$sexo', historia='$historia', idCondicion=$idCondicion, idRaza=$idRaza, idPersonalidad=$idPersonalidad
            WHERE p.idPerro=c.idPerro AND p.idPerro=$idPerro";
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

    echo $option;
  }

function recuperarEstado($id, $campo, $tabla){
    $sql = "SELECT $id, $campo FROM $tabla WHERE perro = 1";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
    $option = $option."<option value=".$row[0].">".ucfirst($row[1])."</option>";    }

    echo $option;
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
               nombre,
               tamanio,
               TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLLegada, INTERVAL -edadEstimadaLLegada MONTH), CURDATE()) as edad,
               sexo,
               historia,
               condicion,
               med.descripcion,
               personalidad,
               pers.descripcion,
               raza,
               rz.descripcion
        FROM perros p, caracteristicas c, condiciones_medicas med, tipo_personalidad pers, tipo_raza rz
        WHERE p.idPerro=c.idPerro
        AND c.idCondicion=med.idCondicion
        AND c.idPersonalidad=pers.idPersonalidad
        AND c.idRaza=rz.idRaza
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

function muestraSolicitudes(){
    $conDb = connectDb();

    $sql = "
    SELECT s.idSolicitud as 'idSolicitud', p.nombre as 'Perro', s.estadoFormulario as 'Formulario', s.estadoEntrevista as 'Entrevista', s.estadoPago as 'Pago'
FROM perros p, usuario u, solicitud s
WHERE u.idUsuario=s.idUsuario AND p.idPerro=s.idPerro AND u.idUsuario='".$_SESSION["id"]."'";

    $tabla = "
    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium\">
        <thead clas>
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

    $solicitudes = $conDb->query($sql);
    while($row = mysqli_fetch_array($solicitudes, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".$row['Perro']."</td>";
        if($row['Formulario'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Tu formulario fue aprobado!\"></a></span></td>";
        }
        elseif($row['Formulario'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: Tu formulario está en proceso de aprobación\"></a></span></td>";
        }
        elseif($row['Formulario'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Tu formulario fue rechazado\"></a></span></td>";
        }

        if($row['Entrevista'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Tu entrevista fue aprobada!\"></a></span></td>";
        }
        elseif($row['Entrevista'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: Tu entrevista está en proceso\"></a></span></td>";
        }
        elseif($row['Entrevista'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Tu entrevista fue rechazada\"></a></span></td>";
        }

        if($row['Pago'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Tu pago fue aprobado!\"></a></span></td>";
        }
        elseif($row['Pago'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: Tu pago está en proceso\"></a></span></td>";
        }
        elseif($row['Pago'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Tu pago fue rechazado\"></a></span></td>";
        }
        $tabla .= '<td ><button type="submit" name="btn-elimina-solicitud" id="'.$row['idSolicitud'].'" class="uk-button-danger uk-button-small uk-button uk-border-rounded uk-align-center" uk-tooltip="title: Eliminar solicitud" onclick="muestraAlert('.$row['idSolicitud'].')"><span uk-icon="icon: trash"></span></button></td>';
        $tabla .= "</tr>";
    }
    mysqli_free_result($solicitudes); //Liberar la memoria
    closeDb($conDb);
    $tabla .= "</tbody></table>";
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
                elseif($row['id'] == 8) {
                    $output .= "<div class=\"uk-margin uk-grid-small uk-child-width-auto uk-grid\">";
                    $output .= "<label><input type='radio' class=\"uk-radio\" name=\"".$row['id']."\" value=\"jardin\"> Jardín</label>";
                    $output .= "<label><input type='radio' class=\"uk-radio\" name=\"".$row['id']."\" value=\"patio\"> Patio</label>";
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
                $output .= "<input type='number' class=\"uk-input uk-border-rounded\" id=\"".$row['id']."\">";
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
    $sql = "SELECT s.idSolicitud as 'idSolicitud', p.nombre as 'Perro', s.estadoFormulario as 'Formulario',s.estadoEntrevista as         'Entrevista', s.estadoPago as 'Pago'
            FROM usuario as u,solicitud as s, perros as p 
            WHERE u.idUsuario = s.idUsuario AND p.idPerro = s.idPerro";
    $result = sqlqry($sql);
    $tabla = "
    <table class=\"uk-table uk-table-divider uk-table-striped uk-table-large uk-table-hover uk-animation-slide-bottom-medium\">
        <thead clas>
            <tr>
                <th class=\"uk-width-small uk-text-secondary\">Perro</th>
                <th class=\"uk-text-center uk-text-secondary\">Formulario</th>
                <th class=\"uk-text-center uk-text-secondary\">Entrevista</th>
                <th class=\"uk-text-center uk-text-secondary\">Pago</th>
            </tr>
        </thead>
        <tbody>
    ";

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".$row['Perro']."</td>";
        if($row['Formulario'] == 5) { //completado
            $tabla .= "<td class=\" uk-text-center\"><a class=\" uk-link-text\" idSolicitud =" .$row["idSolicitud"]."><span class=\" formulario uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Ya aprobaste este formulario!\"></a></span></td>";
        }
        elseif($row['Formulario'] == 4) { //en proceso
            $tabla .= "<td class=\" uk-text-center\"><a class=\" uk-link-text\" idSolicitud =" .$row["idSolicitud"]."><span class=\" formulario uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: No ha sido revisado este formulario.\"></a></span></td>";
        }
        elseif($row['Formulario'] == 3) { //incompleto
            $tabla .= "<td class=\" uk-text-center\"><a class=\"formulario uk-link-text\"  idSolicitud =" .$row["idSolicitud"].">Formulario</a></td>";
        }
        /*<span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Rechazaste este formulario\"></span>
*/
        if($row['Entrevista'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡Aprobaste esta entrevista!\"></a></span></td>";
        }
        elseif($row['Entrevista'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: Esta entrevista está en proceso.\"></a></span></td>";
        }
        elseif($row['Entrevista'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: Esta entrevista fue rechazada.\"></a></span></td>";
        }

        if($row['Pago'] == 5) { //completado
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-success\" uk-icon=\"icon: check\" uk-tooltip=\"title: ¡El pago fue aprobado!\"></a></span></td>";
        }
        elseif($row['Pago'] == 4) { //en proceso
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-warning\" uk-icon=\"icon: minus\" uk-tooltip=\"title: El pago está en proceso.\"></a></span></td>";
        }
        elseif($row['Pago'] == 3) { //incompleto
            $tabla .= "<td class=\"uk-text-center\"><a class=\"uk-link-text\" href=\"#\"><span class=\"uk-text-center uk-text-danger\" uk-icon=\"icon: close\" uk-tooltip=\"title: El pago fue rechazado\"></a></span></td>";
        }
        $tabla .= "</tr>";
    }
    mysqli_free_result($result); //Liberar la memoria
    $tabla .= "</tbody></table>";
    return $tabla;
    
}

function getFormulario($id){
    $sql = "SELECT p.idPregunta as 'n', p.pregunta as 'pregunta', r.respuesta as 'respuesta', pe.nombre as 'perro', u.nombre as 'usuario'
FROM preguntas as p, respuestas as r, solicitud as s, perros as pe , usuario as u 
WHERE p.idPregunta = r.idPregunta AND $id = r.idSolicitud 
AND s.idPerro = pe.idPerro
AND s.idUsuario = u.idUsuario";
    
    $result = sqlqry($sql);

    
    
    return $result;
}

function eliminarSolicitud($idSolicitud) {
    $sql="
    DELETE FROM solicitud WHERE idSolicitud='".$idSolicitud."'";
    $res=modifyDb($sql);
    return $res;
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
