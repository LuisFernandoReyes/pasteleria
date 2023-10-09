<?php
ob_start();
include("../bd/bd.php");

if (isset($_GET['idPastel']) && is_numeric($_GET['idPastel'])) {
    $idPastel = $_GET['idPastel'];
    $sql = "SELECT * FROM pastel WHERE idPastel = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idPastel);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (!$resultado) {
        echo "Pastel no encontrado.";
        exit;
    }
    $pastel = mysqli_fetch_assoc($resultado);
    if (!$pastel) {
        echo "Pastel no encontrado.";
        exit;
    }
} else {
    echo "ID de pastel no válido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoTipoSabor = $_POST['tipoSabor'];
    $nuevoPrecio = $_POST['precioPastel'];
    $nuevoTamano = $_POST['tamanoPastel'];
    $nuevaDescripcion = $_POST['descripcion'];

    // Verificar nueva imagen
    if ($_FILES['imagen']['error'] === 0) {
        $imagenName = $_FILES['imagen']['name'];
        // Actualizar imagen en bd
        $sqlUpdateImagen = "UPDATE pastel SET imagen = ? WHERE idPastel = ?";
        $stmtUpdateImagen = mysqli_prepare($conexion, $sqlUpdateImagen);
        mysqli_stmt_bind_param($stmtUpdateImagen, "si", $imagenName, $idPastel);
        mysqli_stmt_execute($stmtUpdateImagen);
    }

    // Actualizar pastel
    $sql = "UPDATE pastel SET tipoSabor = ?, precioPastel = ?, tamanoPastel = ?, descripcion = ? WHERE idPastel = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sdssi", $nuevoTipoSabor, $nuevoPrecio, $nuevoTamano, $nuevaDescripcion, $idPastel);

    if (mysqli_stmt_execute($stmt)) {

        // Redireccionar
        header("refresh:1;url=../index.php");
    } else {
        echo "Error al actualizar el pastel.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pastelería</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body style="background-color: #DCE7EF">
<header>
  <nav class="navbar navbar-expand-lg" style="background-color: #E8B0A3;">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Pastelería</a>
      <div class="ml-auto">
        <a class="navbar-brand" href="agregar.php">Agregar nuevo pastel</a>
        <a class="navbar-brand" href="editar.php">Editar/Eliminar</a>
      </div>
    </div>
  </nav>
</header>
    <br>
    <div class="card" style='width: 35rem; margin:auto;'>
        <div class="card-header">
            <h2>Editar Pastel</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="mb-3">
                    <label for="tipoSabor" class="form-label">Editar Sabor del Pastel</label>
                    <input type="text" class="form-control" id="tipoSabor" name="tipoSabor" value="<?php echo $pastel['tipoSabor']; ?>">
                </div>
                <div class="mb-3">
                    <label for="precioPastel" class="form-label">Editar Precio del Pastel</label>
                    <input type="number" class="form-control" id="precioPastel" name="precioPastel" value="<?php echo $pastel['precioPastel']; ?>">
                </div>
                <div class="mb-3">
                    <label for="tamanoPastel" class="form-label">Tamaño del Pastel</label>
                    <input type="text" class="form-control" id="tamanoPastel" name="tamanoPastel" value="<?php echo $pastel['tamanoPastel']; ?>">
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Seleccionar imagen</label>
                    <input class="form-control" type="file" id="imagen" name="imagen">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción del Pastel</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $pastel['descripcion']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="Guardar Cambios">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>

</html>