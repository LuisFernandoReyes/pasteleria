<?
//Conexion
$conexion = mysqli_connect("bd:3306", "root", "bd","pasteleria");

if(!$conexion){
    die("Conexion fallida: " .mysqli_connect_error());
}
// echo "Connexion exitosa";
?>