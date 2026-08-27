<?php
session_start();
include "../includes/header.php"; 
include "../includes/menu.php"; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2>Registrar Sesión Fotográfica</h2>

    <form action="guardar.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Cliente</label>

            <select name="cliente_id" class="form-select" required>
                <option value="">Seleccione un cliente</option>

                <?php
                include "../config/conexion.php";

                $sql = "SELECT * FROM clientes ORDER BY nombre ASC";
                $resultado = $conexion->query($sql);

                while($cliente = $resultado->fetch_assoc()) {
                ?>

                    <option value="<?php echo $cliente["id"]; ?>">
                        <?php echo $cliente["nombre"] . " " . $cliente["apellido"]; ?>
                    </option>

                <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de sesión</label>

            <select name="tipo" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Retrato">Retrato</option>
                <option value="Boda">Boda</option>
                <option value="Evento">Evento</option>
                <option value="Cumpleaños">Cumpleaños</option>
                <option value="Sesión familiar">Sesión familiar</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>

            <select name="estado" class="form-select">
                <option value="Pendiente">Pendiente</option>
                <option value="Confirmada">Confirmada</option>
                <option value="Completada">Completada</option>
                <option value="Cancelada">Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Notas</label>
            <textarea name="notas" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar sesión
        </button>

        <a href="sesiones.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>