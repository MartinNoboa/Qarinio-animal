<?php
function limpia_entrada($variable) {
    return $variable = htmlspecialchars($variable);
}
function connectDb(){
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $dbname = "qarinioAnimal";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Checks connection
    if(!$con){
        die("Estamos trabajando para arreglar este problema! " . mysqli_connect_error());
    }

    return $con;
}
function closeDb($mysqli){
    mysqli_close($mysqli);
}

//Función que conecta a la bd, realiza un query y vuelve a cerrar la bd. Recibe el SQL del query y regresa un objeto mysqli result
function sqlqry($qry){
    $con = connectDb();
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

function recuperarUsuarios(){
    $sql = "SELECT u.usuario,u.nombre,r.nombre from usuario u, rol r, desempenia d WHERE u.id=d.usuario_id AND r.id=d.rol_id";
    return sqlqry($sql);
}

function autenticar($username, $password){
    //Recupera los permisos del usuario (desemenia es la relación entre usuario y rol)
    $query = "	SELECT p.nombre as per, u.nombre as nom
				FROM 	`usuario` u, `desempenia` d, `rol` r, `obtiene` o, `permiso` p
				WHERE 	u.id = d.usuario_id
				AND 	d.rol_id = r.id
                AND     o.rol_id = r.id
				AND 	o.permiso_id = p.id
				AND 	usuario='$username'";
    $result = sqlqry($query);

    //Recupera unicamente el password del usuario para poder verificarlo
    $passQuery = " 	SELECT u.password as passHash
					FROM 	`usuario` as u
					WHERE 	usuario='$username'";
    $passHash = mysqli_fetch_object(sqlqry($passQuery))->passHash;

    //asigna los permisos del usuario a la sesión
    if (password_verify($password, $passHash)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            //asigna permisos
            if ($row['per'] == 'registrar') {
                $_SESSION['registrar'] = 1;
                echo 'registrar';
            }
            if ($row['per'] == 'ver') {
                $_SESSION['ver'] = 1;
                echo 'ver';
            }
            //asigna el nombre de usuario
            $_SESSION['nombre'] = $row['nom'];
        }
    }
}

function cuentaExistente($email){
    $q = "  SELECT u.email 
            FROM usuario as u
            WHERE usuario='$email'";
    return false;
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
    $dml = "INSERT INTO usuario (nombre, apellido, email, telefono, callePrincipal, calleSecundaria, numeroExterior, numeroInterior, cp, colonia, ciudad, estado, fechaNacimiento, contrasenia)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    //Usa una función para correr el código SQL de manera segura. Regresa el id del registro insertado
    $uId= insertIntoDb($dml, $nombre, $apellido, $email, $telefono, $callePrincipal, $calleSecundaria, $numeroExterior, $numeroInterior, $cp, $colonia, $ciudad, $estado, $fechaNacimiento, $contrasenia);
    //Recupera el id de el rol a asignar
    $rId = mysqli_fetch_object(sqlqry("SELECT id FROM `rol` WHERE nombre='$rol'"))->id;
    //SQL para asignar rol a usuario
    $dml = "INSERT INTO usuario_rol (usuario_id, rol_id) VALUES (?,?)";
    //Usa la función de insertar para agregar rol
    insertIntoDb($dml, $uId, $rId);

    return 1;
}