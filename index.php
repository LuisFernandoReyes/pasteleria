<!doctype html>
<html lang="en">

<head>
  <title>Pastelería</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>


<body style="background-color: #DCE7EF">
<header>
  <nav class="navbar navbar-expand-lg" style="background-color: #E8B0A3;">
    <div class="container">
      <a class="navbar-brand" href="./index.php">Pastelería</a>
      <div class="ml-auto">
        <a class="navbar-brand" href="./vista/agregar.php">Agregar nuevo pastel</a>
        <a class="navbar-brand" href="./vista/editar.php">Editar/Eliminar</a>
      </div>
    </div>
  </nav>
</header>

  <br>
  <section class="fixCard">
    <?php
    ob_start();
    include("./bd/bd.php");
    include("./vista/BoxesPastel.php");
    ?>

  </section>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>