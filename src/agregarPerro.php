<?php

    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
    if(checkPriv("registrar")):

     foreach($_POST as &$key){
        $key = limpia_entrada($key);        
    }

?>
   


   <div class = "uk-container uk-width-xxlarge">

    <form  class = "uk-align-center" action = "controlador_agregar_perro.php" method = "POST" enctype="multipart/form-data">
        

        <fieldset class="uk-fieldset">
    <div class = "uk-margin-top">

        <h3 class = "uk-inline">Agregar Perro</h3>
        <a href='catalogo' uk-tooltip = 'Click para retroceder' class='uk-icon-link uk-align-left' uk-icon='arrow-left'; ratio ='2'></a>
    </div>

        <div class="uk-margin">
            <h5>Nombre</h5>
            <input class="uk-input uk-border-rounded " type="text" placeholder="Nombre" name = "nombre" id = "nombre" required>
        </div>

        <div class="uk-margin">
            <h5>Tamaño</h5>
            <select class="uk-select uk-border-rounded" id = "size" name = "size" required>
                <option selected hidden>Tamaño...</option>
                <option value = "Pequeño">Pequeño</option>
                <option value = "Mediano">Mediano</option>
                <option value = "Grande">Grande</option>
            </select>
        </div>
        <h5>Edad</h5>
        <div class = "uk-margin-small-top">
            <div class="uk-width-1-4@s">
                <input class="uk-input uk-border-rounded" type="number" min = "0"  placeholder="Meses" id = "meses" name= "meses" required>
            </div>
        </div>

        <div class = "uk-margin">
            <h5>Fecha de Llegada</h5>
            <input class = "uk-input uk-border-rounded " type = "date" id = "fecha" name = "fecha" required>
        </div>

            <h5>Género</h5>
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-radio" type="radio" name="genero"  value = "macho" checked> Macho</label>
            <label><input class="uk-radio" type="radio" name="genero" value = "hembra"> Hembra</label>
        </div>
        <div class="uk-margin">
            <h5>Condiciones Medicas</h5>
            <select class="uk-select uk-border-rounded" id = "condiciones" name = "condiciones" required>
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarOpciones(idCondicion, condicion, condiciones_medicas) ?>
            </select>
        </div>
        <div class="uk-margin">
            <h5>Personalidad</h5>
            <select class="uk-select uk-border-rounded" id = "personalidad" name = "personalidad" required>
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarOpciones(idPersonalidad, personalidad, tipo_personalidad) ?>
            </select>
        </div>
        <div class="uk-margin">
            <h5>Tipo de Actividad</h5>
            <select class="uk-select uk-border-rounded" id = "raza" name = "raza" required>
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarOpciones(idRaza, raza, tipo_raza) ?>
            </select>
        </div>
        
        <div class="uk-margin">
            <h5>
                Estado del Perro
                <span  uk-tooltip = "title : Seleccione el estado del perro. Recuerde que solo se mostrara en el catalogo si esta disponible.; pos :top-left" uk-icon="icon:question; ratio: 0.8"></span>
            </h5>
            <select class="uk-select uk-border-rounded" id = "estado" name = "estado" required>
                <option selected hidden value = "">Seleccione una opcion...</option>
                <?= recuperarEstado(idEstado, nombre, estado) ?>
            </select>
        </div>
        <div class="uk-margin">
            <h5>Historia del perro</h5>
            <textarea id = "historia" class="uk-textarea uk-border-rounded" rows="7" placeholder="Historia" name = "historia" required></textarea>
        </div>
        
        
            
         <div class="uk-margin" uk-margin>
            <div uk-form-custom="target: true">
                <h5>Agregar foto</h5>
                <input class ="uk-border-rounded"  id = "foto"  name = "foto" type="file">
                <input class="uk-input uk-form-width-medium" type="text" placeholder="Seleccione una foto">
            </div>
        </div>
        
        
        
        <div class="uk-margin">
            <button type = "submit" id = "agregar" class = "uk-button uk-button-primary uk-position-relative uk-position-center uk-margin-large-top uk-border-rounded">Agregar perro</button>
        </div>
        
        </fieldset>
    </form>

</div>


<?php else:
    http_response_code(404);
    header("location:_error.html");
    endif;
    include("_footer.html");
?>

<script>
    //$("#agregar")[0].onclick = agregarPerro;
    //$("#agregar")[0].onclick = agregarFoto;
    
</script>