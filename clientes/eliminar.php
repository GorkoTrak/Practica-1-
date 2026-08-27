<?php

session_start();

include "../config/conexion.php";

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

// Eliminar cliente
$sql = "DELETE FROM clientes WHERE id=?";

$stmt = $conexion->prepare($sql);

// El ID es entero
$stmt->bind_param("i", $id);

// Ejecutar
if($stmt->execute())
{
    $_SESSION["mensaje"] = "Cliente eliminado correctamente.";

    header("Location: clientes.php");
    exit();
}
else
{
    $_SESSION["error"] = "Error al eliminar el cliente.";

    header("Location: clientes.php");
    exit();
}

?>