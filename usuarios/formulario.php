<?php

session_start();

include "../includes/menu.php";

if(!isset($_SESSION["rol"]) || $_SESSION["rol"] != "administrador")
{
    $_SESSION["error"] = "No tienes permiso para acceder.";

    header("Location: ../index.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulario</title>
</head>
<body>
    
    <div class="container mt-4">
        <?php
        if(isset($_SESSION["mensaje"]))
        {
            echo '<div class="alert alert-success alert-dismissible fade show">';
            echo $_SESSION["mensaje"];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';

            unset($_SESSION["mensaje"]);
        }

        if(isset($_SESSION["error"]))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show">';
            echo $_SESSION["error"];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';

            unset($_SESSION["error"]);
        }
        ?>
        <div class="card">

            <div class="card-header">
                <h3>Registrar usuario</h3>
            </div>

            <div class="card-body">

                <form action="guardar_usuario.php" method="POST">

                    <div class="mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Correo
                        </label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Rol
                        </label>

                        <select
                            name="rol"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Seleccione un rol
                            </option>

                            <option value="administrador">
                                Administrador
                            </option>

                            <option value="empleado">
                                Empleado
                            </option>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Registrar usuario
                    </button>

                </form>

            </div>

        </div>

    </div>

</form>

<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>