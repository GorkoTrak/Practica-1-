<?php

session_start();

include "../config/conexion.php";

$correo = $_POST["correo"];
$password = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE correo='$correo'";

$resultado = $conexion->query($sql);

if($resultado->num_rows == 1)
{
    $fila = $resultado->fetch_assoc();

    if(password_verify($password,$fila["password"]))
    {
        $_SESSION["usuario"] = $fila["nombre"];

        header("Location: ../index.php");
        exit();
    }
    else
    {
        echo "Correo o contraseña incorrectos.";
    }
}
else
{
    echo "Correo o contraseña incorrectos.";
}