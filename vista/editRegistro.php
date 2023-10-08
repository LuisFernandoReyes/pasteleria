<?php
include("../bd/bd.php");

if (isset($_GET['idPastel']) && is_numeric($_GET['idPastel'])) {
    $idPastel = $_GET['idPastel'];
    $sql = "SELECT * FROM pastel WHERE idPastel = :idPastel";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idPastel', $idPastel, PDO::PARAM_INT);
    $stmt->execute();

    $pastel = $stmt->fetch(PDO::FETCH_ASSOC);

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

    $sql = "UPDATE pastel SET tipoSabor = :tipoSabor, precioPastel = :precioPastel, tamanoPastel = :tamanoPastel, imagen = :imagen, descripcion = :descripcion WHERE idPastel = :idPastel";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':tipoSabor', $nuevoTipoSabor);
    $stmt->bindParam(':precioPastel', $nuevoPrecio);
    $stmt->bindParam(':tamanoPastel', $nuevoTamano);
    $stmt->bindParam(':imagen', $nuevaImagen);
    $stmt->bindParam(':descripcion', $nuevaDescripcion);
    $stmt->bindParam(':idPastel', $idPastel, PDO::PARAM_INT);

    if ($stmt->execute()) {
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
