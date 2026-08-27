<?php
include "../includes/header.php";
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div class="container mt-4">
    <h2>Iniciar Sesión</h2>

    <form action="procesar_login.php" method="POST">

        <label>Correo</label><br>

        <input
            type="email"
            name="correo"
            required
        >

        <br><br>

        <label>Contraseña</label><br>

        <input
            type="password"
            name="password"
            required
        >

        <br><br>

        <button type="submit">

            Ingresar

        </button>

    </form>

</div>
</body>

</html>
<?php
include "../includes/footer.php";
?> 
