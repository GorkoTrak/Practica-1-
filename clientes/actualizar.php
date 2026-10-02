<?php

session_start();

include "../config/conexion.php";

//negar entrar si no es administrador
if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

// Recibir datos
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$direccion = $_POST["direccion"];
$notas = $_POST["notas"];

// Validar campos obligatorios
if(empty($nombre) || empty($apellido) || empty($telefono) || empty($email))
{
    $_SESSION["error"] = "Nombre, apellido, teléfono y correo son obligatorios.";

    header("Location: editar.php?id=" . $id);
    exit();
}

// Validar correo
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $_SESSION["error"] = "El correo no tiene un formato válido.";

    header("Location: editar.php?id=" . $id);
    exit();
}

// Actualizar cliente
$sql = "UPDATE clientes
        SET nombre=?, apellido=?, telefono=?, email=?, direccion=?, notas=?
        WHERE id=?";

$stmt = $conexion->prepare($sql);

// s = texto, i = entero
$stmt->bind_param(
    "ssssssi",
    $nombre,
    $apellido,
    $telefono,
    $email,
    $direccion,
    $notas,
    $id
);

// Ejecutar
if($stmt->execute())
{
    $_SESSION["mensaje"] = "Cliente actualizado correctamente.";

    header("Location: clientes.php");
    exit();
}
else
{
    $_SESSION["error"] = "Error al actualizar el cliente.";

    header("Location: editar.php?id=" . $id);
    exit();
}

?>