<?php
$host = "localhost";
$usuario = "Dark";
$contrasena = "222312";
$base_datos = "tienda_hora_aventuras";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
