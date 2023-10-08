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
    $nuevaImagen = $_POST['imagen'];
    $nuevaDescripcion = $_POST['descripcion'];

    $sql = "UPDATE pastel SET tipoSabor = ?, precioPastel = ?, tamanoPastel = ?, imagen = ?, descripcion = ? WHERE idPastel = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sdsssi", $nuevoTipoSabor, $nuevoPrecio, $nuevoTamano, $nuevaImagen, $nuevaDescripcion, $idPastel);

    if (mysqli_stmt_execute($stmt)) {
        echo "El pastel ha sido actualizado correctamente.";
    } else {
        echo "Error al actualizar el pastel.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Editar Pastel</title>
</head>

<body>
    <h1>Editar Pastel</h1>
    <form method="POST">
        <label for="tipoSabor">Sabor:</label>
        <input type="text" name="tipoSabor" value="<?php echo $pastel['tipoSabor']; ?>"><br>
        <label for="precioPastel">Precio:</label>
        <input type="text" name="precioPastel" value="<?php echo $pastel['precioPastel']; ?>"><br>
        <label for="tamanoPastel">Tamaño:</label>
        <input type="text" name="tamanoPastel" value="<?php echo $pastel['tamanoPastel']; ?>"><br>
        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen" value="<?php echo $pastel['imagen']; ?>"><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $pastel['descripcion']; ?></textarea><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>

</html>
