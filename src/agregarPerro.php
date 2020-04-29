<?php 

    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
    if(checkPriv("registrar")):

     foreach($_POST as &$key){
        $key = limpia_entrada($key);
    }

    $camposRequeridos = [
        "nombre",
        "size",
        "meses",
        "fechaLlegada",
        "genero",
        "historia",
        "idCondicion",
        "idRaza",
        "idPersonalidad"
    ];

    if (isset($_POST["submit"])){
        
        $nombre = $_POST["nombre"];
        $size = $_POST["size"];
        $meses = $_POST["meses"];
        $fechaLlegada = $_POST['fecha'];
        $genero = $_POST["genero"];
        $condiciones = $_POST["condiciones"];
        $personalidad = $_POST["personalidad"];
        $raza = $_POST["raza"];
        $historia = $_POST["historia"];
        
         if(!verificaCampos($_POST,$camposRequeridos)){
             $_SESSION["error"] = "Debes llenar todos los campos";
    }else{
        agregarPerro($nombre,$size,$meses, $fechaLlegada, $genero, $historia, $idCondicion,$idRaza, $idPersonalidad);
        }
    
        
    }
   
    
    
        

    
?>

   <div class = "uk-container">
    <form action = "agregarPerro.php" method = "POST">
        
        <fieldset class="uk-fieldset">

        <h3>Agregar Perro</h3>

        <div class="uk-margin">
            <h5>Nombre</h5>
            <input class="uk-input" type="text" placeholder="Nombre" name = "nombre" id = "nombre">
        </div>

        <div class="uk-margin">
            <h5>Tamaño</h5>
            <select class="uk-select" name = "size">
                <option selected hidden>Tamaño...</option>
                <option value = "Pequenio">Pequeño</option>
                <option value = "mediano">Mediano</option>
                <option value = "grande">Grande</option>
            </select>
        </div>
        <h5>Edad</h5>
        <div class = "uk-margin-small-top">    
            <div class="uk-width-1-4@s">
                <input class="uk-input" type="number" placeholder="Meses" id = "meses" name= "meses">
            </div>
        </div>
        
        <div class = "uk-margin">
            <h5>Fecha de Llegada</h5>
            <input class = "uk-input" type = "date" id = "fecha" name = "fecha">
        </div>
        
            <h5>Género</h5>
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-radio" type="radio" name="genero"  value = "macho" checked> Macho</label>
            <label><input class="uk-radio" type="radio" name="genero" value = "hembra"> Hembra</label>
        </div>
        <div class="uk-margin">
            <h5>Condiciones Medicas</h5>
            <select class="uk-select" id = "condiciones" name = "condiciones">
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarOpciones(idCondicion, condicion, condiciones_medicas) ?>
            </select>
        </div>
        <div class="uk-margin">
            <h5>Personalidad</h5>
            <select class="uk-select" id = "personalidad" name = "personalidad">
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarOpciones(idPersonalidad, personalidad, tipo_personalidad) ?>
            </select>
        </div>
        <div class="uk-margin">
            <h5>Raza</h5>
            <select class="uk-select" id = "raza" name = "raza">
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarOpciones(idRaza, raza, tipo_raza) ?>
            </select>
            </div>
        <div class="uk-margin">
            <h5>Historia del perro</h5>
            <textarea class="uk-textarea" rows="7" placeholder="Historia" name = "historia"></textarea>
        </div>
        <div class="uk-margin">
            <button type = "submit"  id = "agregar" class = "uk-button uk-button-primary uk-position-relative uk-position-center uk-margin-large-top">Agregar perro</button>
        </div>
        
        </fieldset>
    </form>
    
</div>


<?php else:
    http_response_code(404);
    header("location:404");
    endif;
    include("_footer.html");
?>


