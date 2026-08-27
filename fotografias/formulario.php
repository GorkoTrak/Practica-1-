<?php

session_start();

include "../config/conexion.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Subir fotografía</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

    <h2>Subir fotografía</h2>

    <form action="guardar.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">

            <label class="form-label">
                Sesión
            </label>

            <select name="sesion_id" class="form-select" required>

                <option value="">
                    Seleccione una sesión
                </option>

                <?php

                $sql = "SELECT
                            sesiones.id,
                            sesiones.fecha,
                            sesiones.hora,
                            sesiones.tipo,
                            clientes.nombre,
                            clientes.apellido
                        FROM sesiones
                        INNER JOIN clientes
                        ON sesiones.cliente_id = clientes.id
                        ORDER BY sesiones.fecha DESC";

                $resultado = $conexion->query($sql);

                while($sesion = $resultado->fetch_assoc())
                {

                    echo '<option value="' . $sesion["id"] . '">';

                    echo $sesion["nombre"] . " " .
                         $sesion["apellido"] .
                         " - " .
                         $sesion["tipo"] .
                         " - " .
                         $sesion["fecha"];

                    echo '</option>';

                }

                ?>

            </select>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Fotografía
            </label>

            <input
                type="file"
                name="fotografia"
                class="form-control"
                accept="image/*"
                required
            >

        </div>


        <button type="submit" class="btn btn-primary">
            Subir fotografía
        </button>

        <a href="fotografias.php" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

</body>

</html>