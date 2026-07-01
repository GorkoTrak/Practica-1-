<?php

include "config/conexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id='$id'";

$resultado = $conexion->query($sql);

$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>

<body>

<h2>Editar Usuario</h2>

<form action="actualizar_usuario.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">

    <label>Nombre</label><br>
    <input type="text" name="nombre" value="<?php echo $fila["nombre"]; ?>"><br><br>

    <label>Correo</label><br>
    <input type="email" name="correo" value="<?php echo $fila["correo"]; ?>"><br><br>

    <button type="submit">Guardar cambios</button>

</form>

</body>
</html>