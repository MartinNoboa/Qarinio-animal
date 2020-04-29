<?php

include_once("dbconfig.php");

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
        //Recupera los permisos del usuario
        $query = "	SELECT p.privilegio as priv, u.nombre as nom
				FROM 	`usuario` u, `usuario_rol` ur, `rol` r, `privilegio_rol` pr, `privilegios` p
				WHERE 	u.idUsuario = ur.idUsuario
				AND 	ur.idRol = r.idRol
                AND     pr.idRol = r.idRol
				AND 	pr.idPrivilegio = p.idPrivilegio
				AND 	email='$email'";
        $result = sqlqry($query);

        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            //asigna permisos
            if ($row['priv'] == 'registrar') {
                $_SESSION['registrar'] = 1;
            }
            if ($row['priv'] == 'ver') {
                $_SESSION['ver'] = 1;
            }
            //asigna el nombre de usuario
            $_SESSION['nombre'] = $row['nom'];
        }
        return 1;
    } else{return 0;}
}

function cuentaExistente($email){
    $q = "  SELECT u.email
            FROM usuario as u
            WHERE email='$email'";
    return sqlqry($q)->num_rows>=1;
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

        return sqlqry($sql);
}
