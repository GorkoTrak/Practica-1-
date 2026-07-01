<?php

include "config/conexion.php";

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$password = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE correo='$correo'";

$resultado = $conexion->query($sql);

if($resultado->num_rows > 0)
{
    echo "Este correo ya está registrado.";
}
else
{
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nombre, correo, password)
    VALUES('$nombre','$correo','$passwordHash')";

    if($conexion->query($sql))
    {
        echo "Usuario registrado correctamente.";
    }
    else
    {
        echo "Ocurrió un error.";
    }
}