<?php

include "../config/conexion.php";

$sql = "SELECT * FROM usuarios";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>

<body>

<h2>Usuarios registrados</h2>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Acciones</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>

<tr>

    <td><?php echo $fila["id"]; ?></td>

    <td><?php echo $fila["nombre"]; ?></td>

    <td><?php echo $fila["correo"]; ?></td>

    <td>
        <a href="editar.php?id=<?php echo $fila["id"]; ?>">Editar</a>
        
        |

        <a href="eliminar.php?id=<?php echo $fila["id"]; ?>">Eliminar</a>
    </td>

</tr>

<?php } ?>

</table>

</body>
</html>
<?php

include "../includes/footer.php";

?>