<!doctype html>
<html lang="en">

<head>
  <title>Pastelería</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./styles/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body style="background-color: #DCE7EF">
  <header>
  <nav class="navbar navbar-expand-lg" style="background-color: #E8B0A3;">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Pastelería</a>
    <a class="navbar-brand" href="./vista/carrito.php">
      <img src="./icons/carrito.png" alt="Carrito de compras" style="max-width: 30px; height: auto;">
    </a>
  </div>
</nav>
    </header>
    <br>
  <div>
    <?php
    include("./vista/boxes.php");
    include("./bd/bd.php");

    $sql = "SELECT idPastel, tipoSabor, precioPastel FROM pastel"; // Selecciona más columnas si es necesario

    $result = $conexion->query($sql);
    
    // Verifica si la consulta fue exitosa
    if ($result) {
        // Verifica si hay al menos un registro
        if ($result->rowCount() > 0) {
            // Itera a través de los resultados y muestra los datos
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "ID del pastel: " . $row["idPastel"] . "<br>";
                echo "Sabor del pastel: " . $row["tipoSabor"] . "<br>";
                echo "Precio del pastel: " . $row["precioPastel"] . "<br>";
                echo "<hr>"; // Separador entre registros, opcional
            }
        } else {
            echo "No se encontraron registros en la tabla 'pastel'.";
        }
    } else {
        echo "Hubo un error en la consulta: " . $conexion->errorInfo()[2];
    }

    ?>
  </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>