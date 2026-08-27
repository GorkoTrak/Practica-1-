<?php

session_start();

include "../config/conexion.php";

// Recibir datos
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

    header("Location: formulario.php");
    exit();
}

// Validar correo
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $_SESSION["error"] = "El correo no tiene un formato válido.";

    header("Location: formulario.php");
    exit();
}

// Insertar cliente
$sql = "INSERT INTO clientes
        (nombre, apellido, telefono, email, direccion, notas)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

// Todos son textos
$stmt->bind_param(
    "ssssss",
    $nombre,
    $apellido,
    $telefono,
    $email,
    $direccion,
    $notas
);

// Ejecutar
if($stmt->execute())
{
    $_SESSION["mensaje"] = "Cliente registrado correctamente.";

    header("Location: clientes.php");
    exit();
}
else
{
    $_SESSION["error"] = "Error al registrar el cliente.";

    header("Location: formulario.php");
    exit();
}

?>