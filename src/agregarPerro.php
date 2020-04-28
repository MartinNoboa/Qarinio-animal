<?php 
    include("_header.html");
    include("_navbar.html");
    include_once("util.php");
    if(check($_SESSION["privilegios"], "registrar")==1):
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
    header("location:404");
    endif;
?>

