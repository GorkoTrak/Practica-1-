<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body>

<h2>Registro de usuario</h2>

<form action="guardar_usuario.php" method="POST">

    <label>Nombre</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Correo</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Contraseña</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registrar</button>

</form>

</body>
</html>