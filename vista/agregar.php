<?php
ob_start();
include("../bd/bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_POST['tipoSabor'])) {
        $tipoSabor = $_POST['tipoSabor'];
    }
    if (isset($_POST['precioPastel'])) {
        $precioPastel = $_POST['precioPastel'];
    }
    if (isset($_POST['tamanoPastel'])) {
        $tamanoPastel = $_POST['tamanoPastel'];
    }
    if (isset($_FILES['imagen'])) {
        $imagen = $_FILES['imagen']['name'];
    }
    if (isset($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
    }

    $sql = "INSERT INTO pastel (tipoSabor, precioPastel, tamanoPastel, imagen, descripcion)
            VALUES ('$tipoSabor', '$precioPastel', '$tamanoPastel', '$imagen', '$descripcion')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro insertado correctamente.";
    } else {

    }

}

$_SESSION['form_submitted'] = true;
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #E8B0A3;">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Pastelería</a>
                <a class="navbar-brand" href="../vista/agregar.php">Agregar</a>
                <a class="navbar-brand" href="./editar.php">Editar/Eliminar</a>
                <a class="navbar-brand" href="./carrito.php">
                    <img src="../carrito.png" alt="Carrito de compras" style="max-width: 30px; height: auto;">
                </a>
            </div>
        </nav>
    </header>
    <main>
        <br>
        <div class="card" style='width: 35rem; margin:auto;'>
            <div class="card-header">
                <h2>Agregar nuevo pastel</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="tipoSabor" class="form-label">Sabor del Pastel</label>
                        <input type="text" class="form-control" id="tipoSabor" name="tipoSabor" placeholder="ejemplo: Chocolate, Fresa, etc.">
                    </div>
                    <div class="mb-3">
                        <label for="precioPastel" class="form-label">Precio del Pastel</label>
                        <input type="number" class="form-control" id="precioPastel" name="precioPastel" placeholder="$">
                    </div>
                    <div class="mb-3">
                        <label for="tamanoPastel" class="form-label">Tamaño del Pastel</label>
                        <input type="text" class="form-control" id="tamanoPastel" name="tamanoPastel" placeholder="ejemplo: Chico, Mediano o Grande">
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Seleccionar imagen</label>
                        <input class="form-control" type="file" id="imagen" name="imagen">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción del Pastel</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Agregar Pastel</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
