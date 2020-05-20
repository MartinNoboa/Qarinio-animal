<?php
    include_once ("util.php");
    include("_header.html");
    include("_navbar.html");
    foreach($_POST as &$key){
        $key = limpia_entrada($key);
    }

    if(!isset($_SESSION["createState"])||$_SESSION["createState"]>3||$_SESSION["createState"]<0) {
        $_SESSION["createState"] = 0;
    }
    if(!isset($_SESSION["error"])) {
        $_SESSION["error"] = false;
    }

    $camposRequeridos = [
        "nombre",
        "apellido",
        "telefono",
        "callePrincipal",
        "numeroExterior",
        "cp",
        "colonia",
        "ciudad",
        "estado",
        "fechaNacimiento"
    ];

    if(isset($_POST["submit"])) {
        if (($_POST["submit"] == "Continuar" || $_POST["submit"] == "Terminar") && isset($_POST['email']) && $_SESSION["createState"] < 2) {
            if ($_POST["email"] == "") {
                $_SESSION["error"] = "Por favor ingresa un correo";
                $_SESSION["createState"] = 0;
            } else if (cuentaExistente($_POST["email"])) {
                $_SESSION["error"] = "El usuario ya existe";
                $_SESSION["createState"] = 0;
            } else {
                if ($_SESSION["createState"] != 0 && !verificaCampos($_POST, $camposRequeridos)) {
                    $_SESSION["error"] = "Debes llenar todos los campos requeridos";
                    $_SESSION["createState"] = 1;
                } elseif ($_SESSION["createState"] == 2 && !verificaCampos($_POST, ["contrasenia, verifContrasenia"])) {
                    $_SESSION["error"] = "Por favor ingresa una contraseña";
                } else {
                    $_SESSION["createState"]++;
                    $_SESSION["error"] = false;
                }
            }
        } elseif ($_POST["submit"] == "Regresar" && $_SESSION["createState"] > 0) {
            $_SESSION["createState"]--;
        }

        if ($_SESSION["createState"] == 2 && $_POST["submit"] == "Terminar") {
            $datosCuenta = [
                $_POST["nombre"],
                $_POST["apellido"],
                $_POST["email"],
                $_POST["telefono"],
                $_POST["callePrincipal"],
                $_POST["calleSecundaria"],
                $_POST["numeroExterior"],
                $_POST["numeroInterior"],
                $_POST["cp"],
                $_POST["colonia"],
                $_POST["ciudad"],
                $_POST["estado"],
                $_POST["fechaNacimiento"],
                $_POST["contrasenia"],
                "registrado-no-verificado"
            ];
            if(crearCuenta(...$datosCuenta)){
                $_SESSION["mensaje"]="Se ha creado la sesión con éxito";
                $_SESSION["createState"]=null;
                autenticar($_POST["email"], $_POST["contrasenia"]);
                header("location:/");
                exit;
            } else{
                $_SESSION["error"] = "Hubo un error al crear la cuenta";
            }
            //$res = crearCuenta($_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["telefono"], $_POST["callePrincipal"], $_POST["calleSecundaria"], $_POST["numeroExterior"], $_POST["numeroInterior"], $_POST["cp"], $_POST["colonia"], $_POST["ciudad"], $_POST["estado"], $_POST["fechaNacimiento"], $_POST["contrasenia"], "registrado");
        }
    }

?>

<div class = "uk-container">
  <form method="post" action="crearCuenta.php" name='sign-up' id="sign-up">
    <legend class="uk-legend">Crear Cuenta</legend>
      <div <?= $_SESSION["createState"]==2?"hidden":"" ?>>
          <div class="uk-margin">
              <label class="uk-form-label">Nombre:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="nombre" placeholder="Nombre" <?= isset($_POST["nombre"])?"value='{$_POST['nombre']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Apellido(s):<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="apellido" placeholder="Apellido(s)"  <?= isset($_POST["apellido"])?"value='{$_POST['apellido']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Email:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="email" id="email" name="email" placeholder="Correo"  <?= isset($_POST["email"])?"value='{$_POST['email']}'":"" ?>  <?= ($_SESSION["createState"]!=0)?"readonly":"" ?>>
          </div>
      </div>

      <div <?= $_SESSION["createState"]!=1?"hidden":"" ?>>

          <!-- ############################################
               Solo mostrar esto si el email NO está en uso
               ############################################ -->
          <div class="uk-margin">
              <label class="uk-form-label">Teléfono:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="tel" name="telefono" id='telefono' placeholder="1234567890"  pattern='[0-9]{10}' <?= isset($_POST["telefono"])?"value='{$_POST['telefono']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Calle Principal:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="callePrincipal" placeholder="Calle 1" <?= isset($_POST["callePrincipal"])?"value='{$_POST['callePrincipal']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Calle Secundaria:</label>
              <input class="uk-input" type="text" name="calleSecundaria" placeholder="Calle 2" <?= isset($_POST["calleSecundaria"])?"value='{$_POST['calleSecundaria']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Número Exterior:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="number" name="numeroExterior" placeholder="123" <?= isset($_POST["numeroExterior"])?"value='{$_POST['numeroExterior']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Número Interior:</label>
              <input class="uk-input" type="number" name="numeroInterior" placeholder="42"<?= isset($_POST["numeroInterior"])?"value='{$_POST['numeroInterior']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Código Postal:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="cp" placeholder="11560" <?= isset($_POST["cp"])?"value='{$_POST['cp']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Colonia:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="colonia" placeholder="Colonia" <?= isset($_POST["colonia"])?"value='{$_POST['colonia']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Ciudad:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="ciudad" placeholder="Querétaro" <?= isset($_POST["ciudad"])?"value='{$_POST['ciudad']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Estado:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="text" name="estado" placeholder="Estado" <?= isset($_POST["estado"])?"value='{$_POST['estado']}'":"" ?>>
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Fecha de Nacimiento:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="date" max="2001-01-01"  min="1950-01-01" name="fechaNacimiento" placeholder="Fecha de Nacimiento" <?= isset($_POST["fechaNacimiento"])?"value='{$_POST['fechaNacimiento']}'":"" ?>>
          </div>
      </div>
      <div <?= $_SESSION["createState"]!=2?"hidden":"" ?>>
          <div class="uk-margin">
              <label class="uk-form-label">Contraseña:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="password" pattern=".{8,}" name="contrasenia"  id="contrasenia" placeholder="">
          </div>
          <div class="uk-margin">
              <label class="uk-form-label">Verifica Tu contraseña:<label class="uk-form-label uk-text-danger">*</label></label>
              <input class="uk-input" type="password" pattern=".{8,}" name="verifContrasenia" id="verifContrasenia" placeholder="">
          </div>
      </div>
      <progress class="uk-progress" value="<?= $_SESSION["createState"]+1 ?>" max="4"></progress>
      <?php if($_SESSION["error"]): ?>
      <h3 class="uk-alert-danger">Error: <?= $_SESSION["error"] ?> </h3>
      <?php endif; ?>

      <?php
      switch($_SESSION["createState"]){
          case 0:
              echo "<input class='uk-input' type='submit' name='submit' value='Continuar'>";
              break;
          case 1:
              echo "<input class='uk-input' type='submit' name='submit' value='Regresar'>";
              echo "<input class='uk-input' type='submit' name='submit' value='Continuar'>";
              break;
          case 2:
              echo "<input class='uk-input' type='submit' name='submit' value='Regresar'>";
              echo "<input class='uk-input' type='submit' name='submit' id='terminar' value='Terminar' disabled = 'true'>";
              break;
          default:
              break;
      }
      ?>

  </form>
</div>

      <?php
      switch($_SESSION["createState"]){
          case 2:
              echo "<div class = 'uk-container'>";
              echo "<h3>La Contraseña debe de contener los siguientes requisitos:</h3>";
              echo "<p id='minuscula' name='minuscula' class='uk-text-danger'>Una letra <b>Minuscula</b> </p>";
              echo "<p id='mayuscula' name='mayuscula' class='uk-text-danger'>Una letra <b>Mayuscula</b> </p>";
              echo "<p id='numero' name='numero' class='uk-text-danger'>Un <b>numero</b></p>";
              echo "<p id='caracteres' name='caracteres' class='uk-text-danger'>Minimo de <b>8 caracteres</b></p>";
              echo "<p id='coincidir'  name='coincidir' class='uk-text-danger'>Coincidir <b>contraseña con la verificacion</b></p>";
              echo "</div>";
              break;
          default:
              break;
      }
      ?>

<script src="js/validaciones.js"></script>
<script>verifLogin()</script>
<?php
  include("_footer.html");
?>
      <div class="uk-margin">
