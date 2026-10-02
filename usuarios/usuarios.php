<?php

include "../config/conexion.php";

include "../includes/header.php";

include "../includes/menu.php";

//negar entrar si no es administrador
if(!isset($_SESSION["rol"]) || $_SESSION["rol"] != "administrador")
{
    $_SESSION["error"] = "No tienes permiso para acceder.";

    header("Location: ../index.php");
    exit();
}

if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

$sql = "SELECT * FROM usuarios";

$resultado = $conexion->query($sql);

?>
<div class="container mt-4">

<a href="formulario.php" class="btn btn-success mb-3">
    Agregar Usuario
</a>

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>

<body>

<h2>Usuarios registrados</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

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

 </div>
<?php

include "../includes/footer.php";

?>