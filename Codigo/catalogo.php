<?php 
    include("_header.html");
    include("_navbar.html");
?>

<div class="container">
<h2>Nuestros Perros</h2>
    <div class="row">
    <?php
        $img = "Mario.jpg";
        $name = "Mario";
        
        $d1=new DateTime(null);
        $d2=new DateTime("2012-07-08 11:14:15.889342");
        $diff=$d2->diff($d1)->format('%y Años, %m Meses');

        $age = $diff;

        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");

    ?>
    </div>
</div>


<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Modal Header</h4>
    <p>A bunch of text</p>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
  </div>
</div>


<?php include("_footer.html"); ?>
<script>
  $(document).ready(function(){
    $('.materialboxed').materialbox();
    $('.modal').modal();
  });
</script>