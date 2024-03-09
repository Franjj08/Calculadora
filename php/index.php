<?php
  session_start();

  // Inicializar el array de sesión si aún no existe
if (!isset($_SESSION["numeros"])) {
  $_SESSION["numeros"] = array();
}

// Verificar si el formulario ha sido enviado
if (isset($_POST["numero"])) {
  // Obtener el número enviado por POST
  $numero = $_POST["numero"];
}  
  if (is_numeric($numero)){
    // Agregar el número al array de sesión
  array_push($_SESSION["numeros"], $numero);
  if(empty($_SESSION["numeros"])) {
    $_SESSION["resultado"]= 0;
  }

  // Verificar si se ha enviado el formulario
  if (isset($_POST["confirmar"])) {
    // Verificar si hay números en la sesión
    if (!empty($_SESSION["numeros"])) {
        // Obtener el último número ingresado
        $operacion = $_POST["operacion"];
        $operador = end($_SESSION["numeros"]);
        
        
        switch ($operacion) {
            case "sumar":
                $_SESSION["resultado"] += $operador;
                break;
            case "restar":
                $_SESSION["resultado"] -= $operador;
                break;
            case "multiplicar":
                $_SESSION["resultado"] *= $operador;
                break;
            case "dividir":
                if ($operador == 0) {
                // Mostrar un mensaje de error
                echo "<script>alert('Número inválido, ingresa un número distinto de cero.');</script>";
                }else {
                  $_SESSION["resultado"] /= $operador;
                  $_SESSION["resultado"] = round($_SESSION["resultado"],2);
                }
                break;
            default:
              echo "<script>alert('Número inválido1, ingresa un número valido.');</script>";
        }
      }
    }
  } else {
    if (isset($_POST["reset"])) {
      $_SESSION["numeros"] = array();
      $_SESSION["resultado"] = 0;
    }else{
    echo "<script>alert('Número inválido ingresa un número valido.');</script>";
    }
  }



?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a  class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <form action="index.php" method="post">
                  <div class="mb-3">
                    <label class="form-label">Numero en total = <?php echo $_SESSION["resultado"]; ?></label>
                    <input type="text" name="numero" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <select id="operacion" name="operacion">
                      <option value="sumar">Suma</option>
                      <option value="restar">Resta</option>
                      <option value="multiplicar">Multiplicación</option>
                      <option value="dividir">División</option>
                    </select>
                    <button type="submit" name="confirmar">Confirmar</button>
                    <button type="submit" name="reset">Resetear</button>
                    <!-- Imprimir cada elemento del array -->
                    <?php
                      foreach ($_SESSION["numeros"] as $elemento) {
                        echo "<br>". $elemento ;
                      }
                    ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

