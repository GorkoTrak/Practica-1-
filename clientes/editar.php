<?php

session_start();

include "../config/conexion.php";

// Verificar que venga el ID
if(!isset($_GET["id"]))
{
    $_SESSION["error"] = "ID no proporcionado.";

    header("Location: clientes.php");
    exit();
}

$id = $_GET["id"];

// Verificar que sea numérico
if(!is_numeric($id))
{
    $_SESSION["error"] = "ID no válido.";

    header("Location: clientes.php");
    exit();
}

// Buscar cliente
$sql = "SELECT * FROM clientes WHERE id=?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();

// Verificar si existe
if($resultado->num_rows == 1)
{
    $fila = $resultado->fetch_assoc();
}
else
{
    $_SESSION["error"] = "Cliente no encontrado.";

    header("Location: clientes.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php

include "../includes/menu.php";

?>

<div class="container mt-4">

    <div class="card">

        <div class="card-header">

            <h3>Editar cliente</h3>

        </div>

        <div class="card-body">

            <form action="actualizar.php" method="POST">

                <!-- Guardamos el ID -->
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $fila["id"]; ?>"
                >

                <!-- Nombre -->
                <div class="mb-3">

                    <label class="form-label">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?php echo $fila["nombre"]; ?>"
                    >

                </div>

                <!-- Apellido -->
                <div class="mb-3">

                    <label class="form-label">
                        Apellido
                    </label>

                    <input
                        type="text"
                        name="apellido"
                        class="form-control"
                        value="<?php echo $fila["apellido"]; ?>"
                    >

                </div>

                <!-- Teléfono -->
                <div class="mb-3">

                    <label class="form-label">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                        value="<?php echo $fila["telefono"]; ?>"
                    >

                </div>

                <!-- Correo -->
                <div class="mb-3">

                    <label class="form-label">
                        Correo
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?php echo $fila["email"]; ?>"
                    >

                </div>

                <!-- Dirección -->
                <div class="mb-3">

                    <label class="form-label">
                        Dirección
                    </label>

                    <input
                        type="text"
                        name="direccion"
                        class="form-control"
                        value="<?php echo $fila["direccion"]; ?>"
                    >

                </div>

                <!-- Notas -->
                <div class="mb-3">

                    <label class="form-label">
                        Notas
                    </label>

                    <textarea
                        name="notas"
                        class="form-control"
                        rows="3"
                    ><?php echo $fila["notas"]; ?></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning"
                >
                    Actualizar
                </button>

                <a
                    href="clientes.php"
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