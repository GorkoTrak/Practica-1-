<?php

session_start();

include "../config/conexion.php";

// Solo el administrador puede registrar usuarios
if(!isset($_SESSION["rol"]) || $_SESSION["rol"] != "administrador")
{
    header("Location: ../index.php");
    exit();
}

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$password = $_POST["password"];
$rol = $_POST["rol"];

// Verificar si el correo ya existe
$sql = "SELECT * FROM usuarios WHERE correo='$correo'";

$resultado = $conexion->query($sql);

if($resultado->num_rows > 0)
{
    $_SESSION["error"] = "Este correo ya está registrado.";

    header("Location: formulario.php");
    exit();
}
else
{
    // Proteger contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Guardar usuario
    $sql = "INSERT INTO usuarios(nombre, correo, password, rol)
            VALUES (?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "ssss",
        $nombre,
        $correo,
        $passwordHash,
        $rol
    );

    if($stmt->execute())
    {
        $_SESSION["mensaje"] = "Usuario registrado correctamente.";

        header("Location: Usuarios.php");
        exit();
    }
    else
    {
        $_SESSION["error"] = "Ocurrió un error al registrar el usuario.";

        header("Location: formulario.php");
        exit();
    }
}

?>