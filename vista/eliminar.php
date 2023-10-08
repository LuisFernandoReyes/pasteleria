<?php
include("../bd/bd.php");

if (isset($_GET['idPastel']) && is_numeric($_GET['idPastel'])) {
    $idPastel = $_GET['idPastel'];

    $sql = "DELETE FROM pastel WHERE idPastel = :idPastel";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idPastel', $idPastel, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: editar.php?mensaje=El%20pastel%20ha%20sido%20eliminado%20correctamente.");
        exit(); 
    } else {
        echo "Error al eliminar el pastel.";
    }
} else {
    echo "ID de pastel no válido.";
}
?>
