<?php

session_start();

include "../config/conexion.php";

if(!isset($_GET["id"]))
{
    $_SESSION["error"] = "ID no proporcionado.";
    header("Location: sesiones.php");
    exit();
}

$id = $_GET["id"];

if(!is_numeric($id))
{
    $_SESSION["error"] = "ID no válido.";
    header("Location: sesiones.php");
    exit();
}

$sql = "DELETE FROM sesiones WHERE id = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i", $id);

if($stmt->execute())
{
    $_SESSION["mensaje"] = "Sesión eliminada correctamente.";
}
else
{
    $_SESSION["error"] = "No se pudo eliminar la sesión.";
}

header("Location: sesiones.php");
exit();