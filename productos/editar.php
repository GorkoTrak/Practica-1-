<?php

session_start();

include "../config/conexion.php";

// Verificar que venga el ID
if(!isset($_GET["id"]))
{
    echo "ID no proporcionado.";
    exit();
}

$id = $_GET["id"];

// Verificar que sea numérico
if(!is_numeric($id))
{
    echo "ID no válido.";
    exit();
}

// Buscar el producto
$sql = "SELECT * FROM productos WHERE id=?";

$stmt = $conexion->prepare($sql);

// i = entero
$stmt->bind_param("i", $id);

$stmt->execute();

// Obtener resultado
$resultado = $stmt->get_result();

// Verificar si existe
if($resultado->num_rows == 1)
{
    $fila = $resultado->fetch_assoc();
}
else
{
    echo "Producto no encontrado.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar producto</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php

// Incluir menú
include "../includes/menu.php";

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">

            <h3>Editar producto</h3>

        </div>

        <div class="card-body">

            <?php

            // Mostrar error si existe
            if(isset($_SESSION["error"]))
            {
                echo '<div class="alert alert-danger">';
                echo $_SESSION["error"];
                echo '</div>';

                // Eliminar mensaje después de mostrarlo
                unset($_SESSION["error"]);
            }

            ?>

            <!-- Enviar datos a actualizar.php -->
            <form action="actualizar.php" method="POST">

                <!-- Guardar ID del producto -->
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $fila["id"]; ?>"
                >

                <div class="mb-3">

                    <label class="form-label">
                        Nombre del producto
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?php echo $fila["nombre"]; ?>"
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Precio
                    </label>

                    <input
                        type="number"
                        name="precio"
                        class="form-control"
                        value="<?php echo $fila["precio"]; ?>"
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    Actualizar producto
                </button>

                <a
                    href="productos.php"
                    class="btn btn-secondary"
                >
                    Cancelar
                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>