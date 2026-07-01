<?php

include "config/conexion.php";

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];

$sql = "UPDATE usuarios
        SET nombre='$nombre',
            correo='$correo'
        WHERE id='$id'";

if($conexion->query($sql))
{
    header("Location: usuarios.php");
    exit();
}
else
{
    echo "Error al actualizar el usuario.";
}