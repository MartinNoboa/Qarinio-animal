<?php
    include("_header.html");
    include("_navbar.html");
?>


<div id="modal-editar" class="uk-modal-container" uk-modal></div>
<div class="uk-container uk-width-5-6@l uk-width-1-1@s">
    <h2>Nuestros Perros
    <a href="agregarPerro.php" class="uk-icon-link uk-align-right" uk-icon="plus-circle"; ratio = "2"></a>
    </h2>
    <div id="filterMenu" class="uk-height-max-large uk-align-left uk-width-1-4@l uk-width-1-1@s">
        <ul id="listaFiltro" class="uk-nav-primary uk-nav-parent-icon" uk-nav="multiple: true">
            <li class="uk-parent">
                <a href="#">Filtros</a>
                <ul class="uk-nav-sub">
                    <li>Genero</li>
                    <li><label><input class="uk-checkbox" type="checkbox"> Hembra</label></li>
                    <li><label><input class="uk-checkbox" type="checkbox"> Macho</label></li>
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
                            <option value="" disabled>Seleccione una opción</option>
                            <option value="name">Nombre</option>
                            <option value="timeIn">Tiempo en el refugio</option>
                        </select>
                    </li>
                    <hr>
                    <li>Orden</li>
                    <li>
                        <label>
                            <input class="uk-radio" name="order" type="radio" value="asc"/>
                            <span>Ascendiente</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input class="uk-radio" name="order" type="radio" value="desc"/>
                            <span>Descendiente</span>
                        </label>
                    </li>
                    <hr>
                </ul>
            </li>
        </ul>

        <button id="filtrar" class="uk-button uk-button-primary uk-align-right">Aplicar</button>
    </div>

    <div class="uk-child-width-1-3@m" id="contenido-catalogo" uk-grid>




    <?php

        include("controlador_catalogo.php");

    ?>
    </div>
</div>

<?php include("_footer.html"); ?>
<script src="js/nouislider.min.js"></script>
<script src="js/ageRangeSlider.js"></script>
<script src="js/ajax.js"></script>
