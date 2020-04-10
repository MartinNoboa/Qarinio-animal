<?php 
    include("_header.html");
    include("_navbar.html");
?>
<br>
<div class="uk-container ">
  <form >
    <legend class="uk-legend">Iniciar Sesion</legend>
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" >
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
            <input class="uk-input" type="text">
        </div>
    </div>
  </form>
</div>

<?php
  include("_footer.html");
?>