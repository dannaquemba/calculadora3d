<?php

$accion    = $_POST["accion"] ?? "";
$titulo = "";
$resultado = "";
$sala = 1;

switch ($accion) {
   case "calcular_acronimo":
    $sala   = 1;
    $titulo = "Acrónimo obtenido:";
    $frase  = $_POST["frase"] ?? "";

    $frase_mayuscula = mb_strtoupper($frase);

    $frase_mayuscula = str_replace("-", " ", $frase_mayuscula);

    $resultado = "";

    $palabras = explode(" ", $frase_mayuscula);

    foreach ($palabras as $palabra) {
        $palabra = trim($palabra); 

        if ($palabra !== "") {
            $primera_letra = mb_substr($palabra, 0, 1);
            
            $resultado .= $primera_letra;
        }
    }
    break;

    case "calcular_sala2":
        $sala      = 2;
        $n = filter_var($_POST["numero_sala2"] ?? "", FILTER_VALIDATE_INT);
        $operacion = $_POST["operacion_sala2"] ?? "";

        if ($n === false || $n < 0) {
            $titulo    = "Error:";
            $resultado = "Ingresa un número entero mayor o igual a 0.";
            break;
        }

        if ($operacion === "fibonacci") {
            if ($n > 90) {
                $titulo    = "Error:";
                $resultado = "Para Fibonacci el máximo es 90.";
                break;
            }
            $serie = [];
            $a = 0;
            $b = 1;
            for ($i = 0; $i < $n; $i++) {
                $serie[] = $a;
                [$a, $b] = [$b, $a + $b];
            }
            $titulo    = "Fibonacci con $n términos:";
            $resultado = $n === 0 ? "Esta vacia, digite otro número" : implode(", ", $serie);

        } elseif ($operacion === "factorial") {
            if ($n > 20) {
                $titulo    = "Error:";
                $resultado = "Para factorial el máximo es 20.";
                break;
            }
            $serie = [];
            $f = 1;
            for ($i = 0; $i <= $n; $i++) {
                if ($i > 0) {
                    $f *= $i;
                }
                $serie[] = $f;
            }
            $titulo    = "Factorial de $n = $f";
            $resultado = implode(", ", $serie);

        } else {
            $titulo    = "Error";
            $resultado = "Selecciona una operación válida.";
        }
         break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Asimovian&display=swap" rel="stylesheet">
  <title>Resultado</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="pagina-resultado">
  <section class="escenario-3d">
    <div class="prisma-tarjeta">
      <div class="contenido-profundo">
        <span class="numero-sala">PIEZA 0<?php echo $sala; ?> / 07</span>
        <div class="caja-resultado">
          <p class="etiqueta-resultado"><?php echo $titulo; ?></p>
          <span class="valor-resultado"><?php echo htmlspecialchars($resultado); ?></span>
        </div>
        <a class="boton-accion boton-volver" href="index.html#sala-<?php echo $sala; ?>">← Volver a la sala</a>
      </div>
    </div>
  </section>
</body>
</html>