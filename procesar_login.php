<?php

session_start();

include "config/conexion.php";

$correo = $_POST["correo"];

$password = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE correo='$correo'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows == 1)
{
    $fila = $resultado->fetch_assoc();

    if ($fila["password"] == $password)
    {
        // Aquí entraremos si la contraseña es correcta
        $_SESSION["id"] = $fila["id"];
        $_SESSION["nombre"] = $fila["nombre"];
        $_SESSION["correo"] = $fila["correo"];
        
        header("Location: index.php");
        exit();
    }
    else
    {
        echo "Correo o contraseña incorrectos";
    }
}
else
{
    echo "Correo o contraseña incorrectos";
}