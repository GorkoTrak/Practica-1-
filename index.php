<?php

session_start();

if(!isset($_SESSION["usuario"]))
{
    header("Location: auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>

<body>

<h2>Bienvenido</h2>

<p>Hola <?php echo $_SESSION["usuario"]; ?></p>

<a href="usuarios/usuarios.php">Ver usuarios</a>

<br><br>

<a href="auth/logout.php">Cerrar sesión</a>

</body>
</html>