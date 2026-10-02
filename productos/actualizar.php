<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

if(empty($nombre) || empty($precio))
{
    $_SESSION["error"] = "Todos los campos son obligatorios.";

    header("Location: editar.php?id=" . $id);
    exit();
}

if($precio <= 0)
{
    $_SESSION["error"] = "El precio debe ser mayor que cero.";

    header("Location: editar.php?id=" . $id);
    exit();
}

$sql = "UPDATE productos
        SET nombre=?, precio=?
        WHERE id=?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("sdi", $nombre, $precio, $id);

if($stmt->execute())
{
    $_SESSION["mensaje"] = "Producto actualizado correctamente.";

    header("Location: productos.php");
    exit();
}
else
{
    echo "Error al actualizar el producto.";
}

?>