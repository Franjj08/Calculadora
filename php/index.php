<?php
  session_start();
  // Inicializar el array de sesión si aún no existe
  if (!isset($_SESSION["numeros"])) {
    $_SESSION["numeros"] = array();
    $_SESSION["numero_historico"] = array();

  }
  //Iniciar resultado cuando array numeros es vacio
  if(empty($_SESSION["numeros"])) {
    $_SESSION["resultado"]= 0;
  }
  
  //Tira error si click buton confirmar pero input esta vacio
  if(isset($_POST["confirmar"]) && $_POST["numero"] == ""){
    echo "<script>alert('ERROR:Número inválido ingresa un número valido.');</script>";
  }
  // Verificar si se ha enviado el formulario y Verificar si hay números en la sesión
  if (isset($_POST["confirmar"]) && $_POST["numero"] !== "") {
        
        // Agregar el número al array de sesión
        array_push($_SESSION["numeros"], $_POST["numero"]);
        // Obtener el último número ingresado
        $operacion = $_POST["operacion"];
        $operador = end($_SESSION["numeros"]);
        
        
        switch ($operacion) {
            case "sumar":
                $_SESSION["resultado"] += $operador;
                $_SESSION["numero_historico"][]= "+". $operador;
                break;
            case "restar":
                $_SESSION["resultado"] -= $operador;
                $_SESSION["numero_historico"][]= "-". $operador;
                break;
            case "multiplicar":
                $_SESSION["resultado"] *= $operador;
                $_SESSION["numero_historico"][]= "*". $operador;
                break;
            case "dividir":
                if ($operador == 0) {
                // Mostrar un mensaje de error
                echo "<script>alert('Número inválido, ingresa un número distinto de cero.');</script>";
                }else {
                  $_SESSION["resultado"] /= $operador;
                  $_SESSION["resultado"] = round($_SESSION["resultado"],2);
                  $_SESSION["numero_historico"][]= "/". $operador;
                }
                break;
            default:
              echo "<script>alert('E:Número inválido1, ingresa un número valido.');</script>";
        }
      
    }

  if (isset($_POST["confirmar_operacion"]) ) {
    
    $_SESSION["numero_elegido"] = array();

    // Obtener el último número ingresado
    $operacion_elegida = $_POST["operacion_elegida"];
    
    
    switch ($operacion_elegida) {
        case "sumar":
          foreach ($_SESSION["numero_historico"] as $elemento) {
            $simbolo =  substr($elemento,0,1);
            if ($simbolo == '+'){
              $_SESSION["numero_elegido"][] = $elemento;
            }
          }
            break;
        case "restar":
          foreach ($_SESSION["numero_historico"] as $elemento) {
            $simbolo =  substr($elemento,0,1);
            if ($simbolo == '-'){
              $_SESSION["numero_elegido"][] = $elemento;
            }
          }
            break;
        case "multiplicar":
          foreach ($_SESSION["numero_historico"] as $elemento) {
            $simbolo =  substr($elemento,0,1);
            if ($simbolo == '*'){
              $_SESSION["numero_elegido"][] = $elemento;
            }
          }
            break;
        case "dividir":
          foreach ($_SESSION["numero_historico"] as $elemento) {
            $simbolo =  substr($elemento,0,1);
            if ($simbolo == '/'){
              $_SESSION["numero_elegido"][] = $elemento;
            }
          }
            break;
        default:
          echo "<script>alert('E:No hay operacion elegida.');</script>";
    }
  
}
    //Si aprete resetear reinicia todo  
    if (isset($_POST["reset"])) {
      $_SESSION["numeros"] = array();
      $_SESSION["numero_historico"] = array();
      $_SESSION["resultado"] = 0;
    }
    if (isset($_POST["reset_filtro"])) {
      $_SESSION["numero_elegido"] = array();
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
                    <input type="number" name="numero" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                      foreach ($_SESSION["numero_historico"] as $elemento) {
                        echo "<br>". $elemento ;
                      }
                    ?>
                    <br><br>
                    <label class="form-label">Filtro</label>
                    <br>
                    <select name="operacion_elegida">
                      <option value="sumar">Suma</option>
                      <option value="restar">Resta</option>
                      <option value="multiplicar">Multiplicación</option>
                      <option value="dividir">División</option>
                    </select>
                    <button type="submit" name="confirmar_operacion">Confirmar</button>
                    <button type="submit" name="reset_filtro">Resetear</button>
                    <?php
                      foreach ($_SESSION["numero_elegido"] as $elemento) {
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

