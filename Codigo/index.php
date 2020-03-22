
<?php 
  include("_header.html");
  include("_navbar.html");  
?> 

<div class="parallax-container">
    <div class="parallax"><img alt = "Perro sonriente llamado Maybe" src="maybe.jpg"></div>
</div>
<div class="section white">
    <div class="row container">
        <h2 class="header">Parallax</h2>
        <p class="grey-text text-darken-3 lighten-3">Si puedes hacerlo, adopta.<br>
    Si no puedes adoptar, da hogar temporal.<br>
    Si no puedes dar hogar temporal, apadrina.<br>
    Si no puedes apadrinar, transporta.<br>
    Si no puedes transportar, difunde, circula y comparte información.<br>
    Nadie puede salvar a todos los animales, pero todos podemos salvar a uno.<br>
    Tú puedes ser esa persona, házlo.<br>
    ¡Juntos podemos hacer el cambio!</p>
    </div>
</div>
<div class="parallax-container">
    <div class="parallax"><img alt = "Perro golden llamado Nico"src="Nico.jpg"></div>
</div>

<?php include("_footer.html"); ?>
<script>
  $(document).ready(function(){
    $('.parallax').parallax();
  });
</script>
