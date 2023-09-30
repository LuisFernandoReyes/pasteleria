<?php
include("./bd/bd.php");

class BoxesPastel {
    private $idPastel;
    private $tipoSabor;
    private $precioPastel;
    private $tamañoPastel;
    private $imagen;
    private $descripcion;

    // Constructor que solicita los pasteles
    public function __construct($idPastel) {
        global $conexion;
        $sql = "SELECT * FROM pastel WHERE idPastel = $idPastel"; 
        $result = $conexion->query($sql);
        if ($result) {
            if ($result->rowCount() > 0) {
                $row = $result->fetch(PDO::FETCH_ASSOC); 
                $this->idPastel = $row['idPastel'];
                $this->tipoSabor = $row['tipoSabor'];
                $this->precioPastel = $row['precioPastel'];
                $this->tamañoPastel = $row['tamañoPastel'];
                $this->imagen = $row['imagen'];
                $this->descripcion = $row['descripcion'];
            } else {
                echo "No se encontraron registros en la tabla 'pastel'.";
            }
        } else {
            echo "Error en la consulta: " . $conexion->errorInfo()[2];
        }
    }
    
    //Lenar el html que se mostrara en index
    public function generateCardHtml() {
        $html = '<div class="card" style="width: 18rem;">';
        $html .= '<img src="./img/'. $this->imagen . '" class="card-img-top">';
        $html .= '<div class="card-body">';
        $html .= '<h5 class="card-title">Pastel de ' . $this->tipoSabor . ' de tamaño ' . $this->tamañoPastel . '</h5>';
        $html .= '<p class="card-text">' . $this->descripcion . '</p>';
        $html .= '<div class="input-group mb-3">';
        $html .= '<form action="./vista/compra.php" method="POST">';
        $html .= '<input type="hidden" name="idPastel" value="' . $this->idPastel . '">';
        $html .= '<input type="submit" value="Agregar al carrito">';
        $html .= '</form>';
        $html .= '<span class="input-group-text">Precio: $' . $this->precioPastel . '</span>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
    

}

function getRegistros() {
    global $conexion;
    $idRegistros = array();
    $sql = "SELECT idPastel FROM pastel";
    $result = $conexion->query($sql);
    if ($result) {
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $idRegistros[] = $row['idPastel'];
            }
        } else {
            echo "No se encontraron registros en la tabla 'pastel'.";
        }
    } else {
        echo "Error en la consulta: " . $conexion->errorInfo()[2];
    }

    return $idRegistros;
}

// Obtener idPastel
$idsPasteles = getRegistros();

// Iterar sobre las idPastel y para poder generar los cards
foreach ($idsPasteles as $idPastel) {
    $boxesPastel = new BoxesPastel($idPastel);
    $cardHtml = $boxesPastel->generateCardHtml();
    echo $cardHtml;
}
?>
