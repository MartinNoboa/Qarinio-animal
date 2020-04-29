<?php 
    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
    if(checkPriv("registrar")):

     foreach($_POST as &$key){
        $key = limpia_entrada($key);
    }

    if(!isset($_SESSION["error"])) {
            $_SESSION["error"] = false;
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
    <form>
        
        <fieldset class="uk-fieldset">

        <h3>Agregar Perro</h3>

        <div class="uk-margin">
            <h5>Nombre</h5>
            <input class="uk-input" type="text" placeholder="nombre">
        </div>

        <div class="uk-margin">
            <h5>Tamaño</h5>
            <select class="uk-select">
                <option>Tamaño...</option>
                <option>Pequeño</option>
                <option>Mediano</option>
                <option>Grande</option>
            </select>
        </div>
        <h5>Edad</h5>
        <div class="uk-width-1-4@s">
                <input class="uk-input" type="number" placeholder="Años">
        </div>
        <div class = "uk-margin-small-top">    
            <div class="uk-width-1-4@s">
                <input class="uk-input" type="number" placeholder="Meses">
            </div>
        </div>
        
        <div class = "uk-margin">
            <h5>Fecha de Llegada</h5>
            <input class = "uk-input" type = "date">
        </div>
        
            <h5>Género</h5>
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-radio" type="radio" name="radio2" checked> Macho</label>
            <label><input class="uk-radio" type="radio" name="radio2"> Hembra</label>
        </div>
        
         <div class="uk-margin">
            <h5>Historia del perro</h5>
            <textarea class="uk-textarea" rows="7" placeholder="Historia"></textarea>
        </div>
        </fieldset>
    </form>
</div>

<?php else:
    http_response_code(404);
    header("location:404");
    endif;
?>

