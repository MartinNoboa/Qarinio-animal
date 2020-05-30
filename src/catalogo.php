<?php
    include("_header.html");
include("_navbar.html");
include_once("util.php")
?>

<div id="modal-info" class="uk-modal-container" uk-modal></div>
<div id="modal-editar" class="uk-modal-container" uk-modal></div>
<div class="uk-container uk-margin uk-animation-slide-bottom-medium">
    <h1 class="uk-text-center">Nuestros Perros</h1>
    <hr class="uk-divider-icon">
</div>
<?php if(checkPriv("registrar")){
    echo "<a href='agregarPerro' uk-tooltip = 'Agregar perro' class='uk-icon-link uk-align-right uk-margin-large-right' uk-icon='plus-circle'; ratio ='2'></a>";
}
?>
<div id="main" class="uk-margin uk-grid-divider" uk-grid>
    <div id="filterMenu" class="uk-width-1-4 uk-margin-left">
        <ul id="listaFiltro" class="uk-nav-primary uk-nav-parent-icon uk-margin-top" uk-nav="multiple: true">
            <li class="uk-parent">
            <a href="#">Filtros</a>
            <ul class="uk-nav-sub">
                    <li>Buscar</li>
                    <li>
                        <div class="uk-search uk-search-default">
                            <span uk-search-icon></span>
                            <input id="buscarNom" class="uk-search-input" type="search" placeholder="Search...">
                        </div>
                    </li>
                    <hr>
                    <li>Sexo</li>
                    <li><label><input id="hembra" class="uk-checkbox uk-border-rounded" type="checkbox"> Hembra</label></li>
                    <li><label><input id="macho" class="uk-checkbox uk-border-rounded" type="checkbox"> Macho</label></li>
                    <hr>
                    <li>Edad</li>
                    <li>
                        <div id="ageSlider"></div> <div id="ageSlider-value"></div>
                        <div class="hidden" hidden>
                            <input id="minAge" name="minAge" type="number" class="validate">
                            <label for="minAge">Min</label>
                            <input id="maxAge" name="maxAge" type="number" class="validate">
                            <label for="maxAge">Max</label>
                        </div>
                    </li>
                    <hr>
                    <li>Tamaño</li>
                    <li><label><input id="pequeno" class="uk-checkbox uk-border-rounded" type="checkbox"> Pequeño</label></li>
                    <li><label><input id="mediano" class="uk-checkbox uk-border-rounded" type="checkbox"> Mediano</label></li>
                    <li><label><input id="grande" class="uk-checkbox uk-border-rounded" type="checkbox"> Grande</label></li>
                <hr>
                <li></li>
                <li>
                    <select class="uk-select uk-border-rounded" id="raza" name="raza">
                        <?= recuperarOpciones("idRaza", "raza", "tipo_raza") ?>
                    </select>
                </li>
                <hr>
                <li></li>
                <li>
                    <select class="uk-select uk-border-rounded" id="raza" name="raza">
                        <?= recuperarOpciones("idPersonalidad", "personalidad", "tipo_personalidad") ?>
                    </select>
                </li>
                <hr>
                <li></li>
                <li>
                    <select class="uk-select uk-border-rounded" id="raza" name="raza">
                        <?= recuperarOpciones("idCondicion", "condicion", "condiciones_medicas") ?>
                    </select>
                </li>
                </ul>
            </li>
            <li class="uk-parent">
                <a href="#">Ordenar</a>
                <ul class="uk-nav-sub">
                    <li>Ordenar Por</li>
                    <li>
                        <select id="sort" name="sort" class="uk-select uk-border-rounded">
                            <option value="idPerro" selected>Seleccione una opción</option>
                            <option value="name">Nombre</option>
                            <option value="timeIn">Tiempo en el refugio</option>
                            <option value="age">Edad</option>
                        </select>
                    </li>
                    <hr>
                    <li>Orden</li>
                    <li>
                        <label>
                            <input class="uk-radio" name="order" type="radio" value="asc" checked/>
                            <span>Ascendente</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input class="uk-radio" name="order" type="radio" value="desc"/>
                            <span>Descendente</span>
                        </label>
                    </li>
                </ul>
            </li><hr>
            <button id="filtrar" class="uk-button uk-button-primary uk-align-right uk-border-rounded uk-overflow-auto">Aplicar</button>
        </ul>
    </div>

    <div class="uk-width-expand uk-margin-right">
        <div class="uk-animation-slide-bottom-medium" id="contenido-catalogo" uk-grid>
        <?php
            include("controlador_catalogo.php");
        ?>
        </div>
    </div>

</div>

<?php include("_footer.html"); ?>
<script>
    //Asignar al botón buscar, la función buscar()
    document.getElementById("filtrar").onclick = filtrar;

    let waitForTypeStop = null;
    document.getElementById("buscarNom").addEventListener("input", function(){
        clearTimeout(waitForTypeStop);
        waitForTypeStop = setTimeout(function(){
            filtrar();
        }, 500)
    });



    setElEditar();
    setElInfo();
</script>
<script src="js/nouislider.min.js"></script>
<script src="js/ageRangeSlider.js"></script>
