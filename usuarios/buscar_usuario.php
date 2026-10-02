<?php

include "../config/conexion.php";

//negar entrar si no es administrador
if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

$sql = "SELECT * FROM usuarios";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {

    echo "Nombre: " . $fila["nombre"];

    echo "<br>";

    echo "Correo: " . $fila["correo"];

    echo "<hr>";
}