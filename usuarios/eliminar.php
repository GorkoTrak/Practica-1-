<?php

include "../config/conexion.php";

//negar entrar si no es administrador
if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET["id"];

$sql = "DELETE FROM usuarios WHERE id='$id'";

if($conexion->query($sql))
{
    header("Location: usuarios.php");
    exit();
}
else
{
    echo "Error al eliminar el usuario.";
}