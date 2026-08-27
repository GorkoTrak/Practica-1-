<?php

$host = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "fotoestudio2";

$conexion = new mysqli($host, $usuario, $password, $baseDatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

