<?php

session_start();

include "../config/conexion.php";

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

// Validar campos
if(empty($nombre) || empty($precio))
{
    $_SESSION["error"] = "Todos los campos son obligatorios.";

    header("Location: formulario.php");
    exit();
}

// Validar precio
if($precio <= 0)
{
    $_SESSION["error"] = "El precio debe ser mayor que cero.";

    header("Location: formulario.php");
    exit();
}

// Insertar producto
$sql = "INSERT INTO productos (nombre, precio)
        VALUES (?, ?)";

$stmt = $conexion->prepare($sql);

// s = texto, d = decimal
$stmt->bind_param("sd", $nombre, $precio);

if($stmt->execute())
{
    $_SESSION["mensaje"] = "Producto registrado correctamente.";

    header("Location: productos.php");
    exit();
}
else
{
    $_SESSION["error"] = "Error al registrar el producto.";

    header("Location: formulario.php");
    exit();
}

?>