<?php
ob_start();
include("../bd/bd.php");

try {
    $sql = "SELECT * FROM pastel";
    $resultado = mysqli_query($conexion, $sql);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
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
                                    <th>Sabor</th>
                                    <th>Precio</th>
                                    <th>Tamaño</th>
                                    <th>Imagen</th>
                                    <th>Descripción</th>
                                    <th>Editar compra</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<tr>";
                                    echo "<td>" . $fila['tipoSabor'] . "</td>";
                                    echo "<td>" . $fila['precioPastel'] . "</td>";
                                    echo "<td>" . $fila['tamanoPastel'] . "</td>";
                                    echo "<td>" . $fila['imagen'] . "</td>";
                                    echo "<td>" . $fila['descripcion'] . "</td>";
                                    echo "<td><a href='editRegistro.php?idPastel=" . $fila['idPastel'] . "'>Editar</a></td>";
                                    echo "<td><a href='eliminar.php?idPastel=" . $fila['idPastel'] . "' onclick='return confirm(\"¿Está seguro de eliminar este pastel?\");'>Eliminar</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (!empty($mensaje)) {
    echo '<div class="alert alert-success">' . $mensaje . '</div>';
}
?>
