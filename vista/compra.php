<?php
ob_start();
include("../bd/bd.php");

$tipoSabor = "";
$precioPastel = "";
$tamanoPastel = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idPastel'])) {
        $idPastel = $_POST['idPastel'];
        compra($idPastel, $conexion);
    }
    if (isset($_POST['idPastel'])) {
        $idPastel = $_POST['idPastel'];
        insertar($idPastel, $conexion);
    }
}

function insertar($idPastel, $conexion)
{
    // Verifica si el pastel ya existe en el carrito
    $sqlExistencia = "SELECT * FROM carrito WHERE idPastel = ?";
    $stmtExistencia = mysqli_prepare($conexion, $sqlExistencia);
    mysqli_stmt_bind_param($stmtExistencia, "i", $idPastel);
    mysqli_stmt_execute($stmtExistencia);
    $resultadoExistencia = mysqli_stmt_get_result($stmtExistencia);

    if ($resultadoExistencia) {
        $rowExistencia = mysqli_fetch_assoc($resultadoExistencia);

        if ($rowExistencia) {
            // Si existe el pastel, actualizamos la cantidad
            $cantidadActual = $rowExistencia['cantidadPastel'];
            $cantidadNueva = $cantidadActual + 1;

            $sqlActualizar = "UPDATE carrito SET cantidadPastel = ? WHERE idPastel = ?";
            $stmtActualizar = mysqli_prepare($conexion, $sqlActualizar);
            mysqli_stmt_bind_param($stmtActualizar, "ii", $cantidadNueva, $idPastel);
            if (mysqli_stmt_execute($stmtActualizar)) {
                // echo "Se actualizó la cantidad del pastel en el carrito.";
            } else {
                echo "Error al actualizar la cantidad del pastel en el carrito.";
            }
        } else {
            // Si no está el pastel, insertarlo con cantidad de 1
            $sqlInsertar = "INSERT INTO carrito (idPastel, cantidadPastel) VALUES (?, 1)";
            $stmtInsertar = mysqli_prepare($conexion, $sqlInsertar);
            mysqli_stmt_bind_param($stmtInsertar, "i", $idPastel);
            if (mysqli_stmt_execute($stmtInsertar)) {
                echo "Se agregó el pastel al carrito.";
            } else {
                echo "Error al agregar el pastel al carrito.";
            }
        }
    } else {
        echo "Error al verificar la existencia del pastel en el carrito.";
    }
}

function compra($idPastel, $conexion)
{
    global $tipoSabor, $precioPastel, $tamanoPastel;

    $sql = "SELECT * FROM pastel WHERE idPastel = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idPastel);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
        if ($row) {
            $tipoSabor = $row['tipoSabor'];
            $precioPastel = $row['precioPastel'];
            $tamanoPastel = $row['tamanoPastel'];
        } else {
            echo "No se encontró ningún pastel con el ID proporcionado.";
        }
    } else {
        echo "Error al ejecutar la consulta.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pastelería</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body style="background-color: #DCE7EF">
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #E8B0A3;">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Pastelería</a>
                <a class="navbar-brand" href="../vista/agregar.php">Agregar</a>
                <a class="navbar-brand" href="./editar.php">Editar/Eliminar</a>
                <a class="navbar-brand" href="./carrito.php">
                    <img src="../icons/carrito.png" alt="Carrito de compras" style="max-width: 30px; height: auto;">
                </a>
            </div>
        </nav>
    </header>
    <br>
    <section>
        <div class="row">
            <div class="col">
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th>Nombre de producto</th>
                                    <th>Tamaño Pastel</th>
                                    <th>Precio unitario</th>
                                    <th>Agregar</th>
                                    <th>Cancelar</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr class="table-primary">
                                    <td> <?php echo ("Pastel sabor " . $tipoSabor); ?></td>
                                    <td> <?php echo ($tamanoPastel); ?></td>
                                    <td> <?php echo ($precioPastel); ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="idPastel" value="<?php echo $idPastel; ?>">
                                            <button type="submit" name="agregarCarrito">Agregar al Carrito</button>
                                        </form>
                                    </td>
                                    <td> <a href="../index.php">Cancelar</a></td>
                                </tr>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity
