<?php
    include("_header.html");
include("_navbar.html");
include_once("util.php")
?>


<div id="modal-editar" class="uk-modal-container" uk-modal></div>
<div class="uk-container uk-margin">
    <h1>Nuestros Perros
    <hr>
        <?php if(checkPriv("registrar")){
            echo "<a href='agregarPerro.php' uk-tooltip = 'Agregar perro' class='uk-icon-link uk-align-right' uk-icon='plus-circle'; ratio ='2'></a>";
        }
        ?>
    </h1>
</div>
<div id="main" class="uk-flex">
    <div id="filterMenu" class="uk-container uk-width-medium">
        <ul id="listaFiltro" class="uk-nav-primary uk-nav-parent-icon" uk-nav="multiple: true" uk-sticky>
            <li class="uk-parent">
                <a href="#">Filtros</a>
                <ul class="uk-nav-sub">
                    <li>Genero</li>
                    <li><label><input id="hembra" class="uk-checkbox" type="checkbox"> Hembra</label></li>
                    <li><label><input id="macho" class="uk-checkbox" type="checkbox"> Macho</label></li>
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
                </ul>
            </li>
            <li class="uk-parent">
                <a href="#">Ordenar</a>
                <ul class="uk-nav-sub">
                    <li>Ordenar Por</li>
                    <li>
                        <select id="sort" name="sort" class="uk-select">
                            <option value="idPerro" disabled selected>Seleccione una opción</option>
                            <option value="name">Nombre</option>
                            <option value="timeIn">Tiempo en el refugio</option>
                        </select>
                    </li>
                    <hr>
                    <li>Orden</li>
                    <li>
                        <label>
                            <input class="uk-radio" name="order" type="radio" value="asc"/>
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
            <button id="filtrar" class="uk-button uk-button-primary uk-align-right">Aplicar</button>
        </ul>
    </div>

    <hr class="uk-divider-vertical uk-height-large uk-visible@s">

    <div class="uk-container">
        <div class="uk-child-width-1-2" id="contenido-catalogo" uk-grid>
        <?php
            include("controlador_catalogo.php");
        ?>
        </div>
    </div>

</div>

<?php include("_footer.html"); ?>
<script src="js/nouislider.min.js"></script>
<script src="js/ageRangeSlider.js"></script>
