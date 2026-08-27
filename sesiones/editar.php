<?php

session_start();

include "../config/conexion.php";
include "../includes/header.php"; 
include "../includes/menu.php"; 

if(!isset($_GET["id"]))
{
    echo "ID no proporcionado.";
    exit();
}

$id = $_GET["id"];

if(!is_numeric($id))
{
    echo "ID no válido.";
    exit();
}

$sql = "SELECT * FROM sesiones WHERE id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows == 1)
{
    $fila = $resultado->fetch_assoc();
}
else
{
    echo "Sesión no encontrada.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

    <h2>Editar Sesión Fotográfica</h2>

    <form action="actualizar.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">

        <div class="mb-3">

            <label class="form-label">Cliente</label>

            <select name="cliente_id" class="form-select" required>

                <?php

                $sqlClientes = "SELECT * FROM clientes ORDER BY nombre ASC";

                $resultadoClientes = $conexion->query($sqlClientes);

                while($cliente = $resultadoClientes->fetch_assoc())
                {

                    $seleccionado = "";

                    if($cliente["id"] == $fila["cliente_id"])
                    {
                        $seleccionado = "selected";
                    }

                    echo '<option value="' . $cliente["id"] . '" ' . $seleccionado . '>';

                    echo $cliente["nombre"] . " " . $cliente["apellido"];

                    echo '</option>';
                }

                ?>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Fecha</label>

            <input
                type="date"
                name="fecha"
                class="form-control"
                value="<?php echo $fila["fecha"]; ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">Hora</label>

            <input
                type="time"
                name="hora"
                class="form-control"
                value="<?php echo $fila["hora"]; ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">Tipo de sesión</label>

            <select name="tipo" class="form-select" required>

                <option value="Retrato" <?php if($fila["tipo"] == "Retrato") echo "selected"; ?>>
                    Retrato
                </option>

                <option value="Boda" <?php if($fila["tipo"] == "Boda") echo "selected"; ?>>
                    Boda
                </option>

                <option value="Evento" <?php if($fila["tipo"] == "Evento") echo "selected"; ?>>
                    Evento
                </option>

                <option value="Cumpleaños" <?php if($fila["tipo"] == "Cumpleaños") echo "selected"; ?>>
                    Cumpleaños
                </option>

                <option value="Sesión familiar" <?php if($fila["tipo"] == "Sesión familiar") echo "selected"; ?>>
                    Sesión familiar
                </option>

                <option value="Otro" <?php if($fila["tipo"] == "Otro") echo "selected"; ?>>
                    Otro
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Estado</label>

            <select name="estado" class="form-select">

                <option value="Pendiente" <?php if($fila["estado"] == "Pendiente") echo "selected"; ?>>
                    Pendiente
                </option>

                <option value="Confirmada" <?php if($fila["estado"] == "Confirmada") echo "selected"; ?>>
                    Confirmada
                </option>

                <option value="Completada" <?php if($fila["estado"] == "Completada") echo "selected"; ?>>
                    Completada
                </option>

                <option value="Cancelada" <?php if($fila["estado"] == "Cancelada") echo "selected"; ?>>
                    Cancelada
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Notas</label>

            <textarea
                name="notas"
                class="form-control"
                rows="3"
            ><?php echo $fila["notas"]; ?></textarea>

        </div>

        <button type="submit" class="btn btn-primary">
            Actualizar sesión
        </button>

        <a href="sesiones.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>

</html>