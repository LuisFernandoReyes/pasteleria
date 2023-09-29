<?php
$server = "localhost";
$baseDatos = "pasteleria";
$user = "root";
$pass = "";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$baseDatos", $user, $pass);
} catch (Exception $error) {
    echo $error->getMessage();
}
?>
