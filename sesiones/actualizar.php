<?php

session_start();

include "../config/conexion.php";
include "../includes/header.php"; 
include "../includes/menu.php"; 

$id = $_POST["id"];
$cliente_id = $_POST["cliente_id"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$tipo = $_POST["tipo"];
$estado = $_POST["estado"];
$notas = $_POST["notas"];

if(
    empty($id) ||
    empty($cliente_id) ||
    empty($fecha) ||
    empty($hora) ||
    empty($tipo)
)
{
    $_SESSION["error"] = "Cliente, fecha, hora y tipo de sesión son obligatorios.";

    header("Location: sesiones.php");
    exit();
}

$sql = "UPDATE sesiones
        SET cliente_id = ?,
            fecha = ?,
            hora = ?,
            tipo = ?,
            estado = ?,
            notas = ?
        WHERE id = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "isssssi",
    $cliente_id,
    $fecha,
    $hora,
    $tipo,
    $estado,
    $notas,
    $id
);

if($stmt->execute())
{
    $_SESSION["mensaje"] = "Sesión actualizada correctamente.";

    header("Location: sesiones.php");
    exit();
}
else
{
    $_SESSION["error"] = "Error al actualizar la sesión.";

    header("Location: sesiones.php");
    exit();
}