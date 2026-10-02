<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clientes</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php

// Incluir menú
include "../includes/menu.php";

?>

<div class="container mt-4">
    
        <?php

    // Mostrar mensaje
    if(isset($_SESSION["mensaje"]))
    {
        echo '<div class="alert alert-success alert-dismissible fade show">';

        echo $_SESSION["mensaje"];

        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

        echo '</div>';

        unset($_SESSION["mensaje"]);
    }

    // Mostrar error
    if(isset($_SESSION["error"]))
    {
        echo '<div class="alert alert-danger alert-dismissible fade show">';

        echo $_SESSION["error"];

        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

        echo '</div>';

        unset($_SESSION["error"]);
    }

    ?>
    <h1>Clientes</h1>

    <a href="formulario.php" class="btn btn-success mb-3">
        Agregar cliente
    </a>

    <table class="table table-bordered table-striped">

    <thead>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Notas</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

    <?php

    // Obtener clientes
    $sql = "SELECT * FROM clientes";

    $resultado = $conexion->query($sql);

    // Recorrer clientes
    while($fila = $resultado->fetch_assoc())
    {
        echo "<tr>";

        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["apellido"] . "</td>";
        echo "<td>" . $fila["telefono"] . "</td>";
        echo "<td>" . $fila["email"] . "</td>";
        echo "<td>" . $fila["direccion"] . "</td>";
        echo "<td>" . $fila["notas"] . "</td>";

        echo "<td>";

        echo '<a href="editar.php?id=' . $fila["id"] . '" 
                class="btn btn-warning me-2">
                Editar
              </a>';

        echo '<a href="eliminar.php?id=' . $fila["id"] . '"
                class="btn btn-danger"
                onclick="return confirm(\'¿Está seguro de eliminar este cliente?\');">
                Eliminar
            </a>';

        echo "</td>";

        echo "</tr>";
    }

    ?>

    </tbody>

</table>
    


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>