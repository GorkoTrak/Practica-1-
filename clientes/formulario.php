<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar cliente</title>

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

            <h3>Registrar cliente</h3>

    </div>

    <div class="card-body">

        <?php

        // Mostrar error
        if(isset($_SESSION["error"]))
        {
            echo '<div class="alert alert-danger">';

            echo $_SESSION["error"];

            echo '</div>';

            unset($_SESSION["error"]);
        }

        ?>
            <form action="guardar.php" method="POST">

                <!-- Nombre -->
                <div class="mb-3">

                    <label class="form-label">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
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
                    ></textarea>

                </div>


                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Registrar
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