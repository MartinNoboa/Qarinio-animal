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
