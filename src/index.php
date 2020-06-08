
<?php
    $titulo="";
  include("_header.html");
  include("_navbar.html");
?>
    <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top" style="background-image: url('img/maybe.jpg');" uk-parallax="bgy: -300" >
        <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical uk-height-auto">
            <h1 class="uk-text-bold uk-text-emphasis">Qariño Animal</h1>
            <h3 class="uk-text-bold uk-text-italic">Espacio creado para la expresión de animalistas, ayuda y difusión de adopciones.</h3>
            <form class="uk-form" action="catalogo.php" method="post">
                <button class="uk-button uk-button-primary uk-border-pill uk-box-shadow-large" type="submit" name="button">¡Adoptar un perro ahora!</button>
            </form>
        </div>
    </div>
    <div class="uk-section">
        <div class="uk-container">
            <h1 class="uk-text-center">¿Quiénes Somos?</h1>
            <hr class="uk-divider-icon">
            <div class="uk-grid-match uk-child-width-1-2@m" uk-grid="parallax: 250">
                <div uk-scrollspy="cls: uk-animation-slide-bottom-medium; repeat:true" class="uk-width-auto">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title uk-text-center">Labor con amor<i class="fas fa-heart uk-margin-small-left"></i></h3>
                        <p>
                            La asociación  surge  formalmente  en mayo de 2013 cuando nos constituimos, sin embargo
                            ya teníamos 4 años anteriores trabajando en favor de uno de los sectores más vulnerables
                            y sin derechos: el medio ambiente y su cuidado, concientizando en la tenencia responsable
                            de mascotas para evitar enfermedades zoonóticas, protegiendo y cuidando animales
                            abandonados o maltratados, atendiéndolos en un albergue, en el que se les da atención,
                            limpieza, alimento, techo, cariño, y atención médica.<br><br>
                            Nuestra asociación surge al no tener
                            respuesta de las unidades de control animal para atender toda la problemática de perros y
                            gatos abandonados en la calle y/o en situación de maltrato y violencia; pues nos percatamos
                            que esta situación rebasa a las instituciones de gobierno y lo que puede hacer; por lo tanto
                            comenzamos a trabajar para darles un lugar seguro en el que puedan estar resguardados
                            mientras se recuperan de lesiones o para esperar mientras se encuentra una familia u hogar
                            para ellos, y así favorecer la concientización del cuidado de los mismos para prevenir la
                            contaminación por éstos.
                        </p>
                    </div>
                </div>
                <div uk-scrollspy="cls: uk-animation-slide-left; repeat:true">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Nuestra Labor <i class="fas fa-hands-helping uk-margin-small-left"></i></h3>
                        <p>
                            Además de los perros rescatados que viven en el albergue, ayudamos promoviendo y
                            realizando campañas de esterilización, concientización en diferentes comunidades sobre
                            todo para cambiar la situación de los perros y gatos, y con esto colaborar con nuestro Estado
                            en materia de protección y cuidado del medio ambiente.
                        </p>
                    </div>
                </div>
                <div uk-scrollspy="cls: uk-animation-slide-right; repeat:true">
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Nuestros Objetivos<i class="fas fa-bullseye uk-margin-small-left"></i></h3>
                        <p>
                            Somos una organización sin fines de lucro, cuyos objetivos se basan en combatir la
                            desinformación, y ayudar a prevenir contaminación y otras enfermedades que afectan al
                            medio ambiente y a los seres humanos, por medio de campañas y ferias de salud
                            (vacunación, desparasitación, esterilizaciones, etc), promoviendo las adopciones de
                            animales rescatados y no la compra, para educar y ayudar a la población.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Empieza slideshow -->
<script>
UIkit.parallax();
</script>
<?php include("_footer.html");?>
