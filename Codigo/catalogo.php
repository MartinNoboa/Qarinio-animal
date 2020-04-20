<?php 
    include("_header.html");
    include("_navbar.html");
?>

<div class="uk-container">
<div class = "uk-container uk-margin-top">
    <h2>Nuestros Perros
    <a href="agregarPerro.php" class="uk-icon-link uk-align-right" uk-icon="plus-circle"; ratio = "2"></a>
    </h2>
</div>

    <div class="uk-child-width-1-3@m" uk-grid>
    <?php
        $img = "img/maybe.jpg";
        $name = "Mario";
        
        $d1=new DateTime(null);
        $d2=new DateTime("2012-07-08 11:14:15.889342");
        $diff=$d2->diff($d1)->format('%y Años, %m Meses');

        $age = $diff;

        include("_tarjetaPerro.html");
        
        $img = "img/Mario.jpg";
        include("_tarjetaPerro.html");
        
        $img = "img/Nico.jpg";
        include("_tarjetaPerro.html");
        
        $img = "img/Paco.jpg";
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");

    ?>
    </div>
</div>



<?php include("_footer.html"); ?>
