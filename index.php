<?php

session_start();

if(!isset($_SESSION["usuario"]))
{
    header("Location: auth/login.php");
    exit();
}

include "includes/header.php";
include "includes/menu.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>

<body>
<div class="container">

    <div class="card">

        <div class="card-header">
            Panel principal
        </div>

        <div class="card-body">

            <h2>Bienvenido</h2>

            <p>Hola <?php echo $_SESSION["usuario"]; ?></p>

            <p>
                Correo: <?php echo $_SESSION["correo"]; ?>
            </p>

        </div>

    </div>

</div>

</body>
</html>

<?php
include "includes/footer.php";
?>