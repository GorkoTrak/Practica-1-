<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

// Verificar que venga el ID
if(!isset($_GET["id"]))
{
    echo "ID no proporcionado.";
    exit();
}

$id = $_GET["id"];

// Verificar que sea numérico
if(!is_numeric($id))
{
    echo "ID no válido.";
    exit();
}

// Eliminar producto
$sql = "DELETE FROM productos WHERE id=?";

$stmt = $conexion->prepare($sql);

// i = entero
$stmt->bind_param("i", $id);

if($stmt->execute())
{
    // Verificar si se eliminó
    if($stmt->affected_rows > 0)
    {
        $_SESSION["mensaje"] = "Producto eliminado correctamente.";
    }
    else
    {
        $_SESSION["error"] = "El producto no existe.";
    }

    header("Location: productos.php");
    exit();
}
else
{
    echo "Error al eliminar el producto.";
}

?>