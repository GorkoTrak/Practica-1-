<?php

session_start();


include "../config/conexion.php";

include "../includes/header.php";

include "../includes/menu.php";

if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

$sql = "SELECT * FROM productos";

$resultado = $conexion->query($sql);

?>  
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Productos</title>

    <!-- Bootstrap --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">    

        <div class="card">

            <div class="card-header">
                Productos
            </div>

            <div class="card-body">

                <a href="formulario.php" class="btn btn-success mb-3">
                    Agregar producto
                </a>
                    <?php

                // Mensaje de éxito
                if(isset($_SESSION["mensaje"]))
                {
                    echo '<div class="alert alert-success alert-dismissible fade show">';

                    echo $_SESSION["mensaje"];

                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

                    echo '</div>';

                    unset($_SESSION["mensaje"]);
                }


                // Mensaje de error
                if(isset($_SESSION["error"]))
                {
                    echo '<div class="alert alert-danger alert-dismissible fade show">';

                    echo $_SESSION["error"];

                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

                    echo '</div>';

                    unset($_SESSION["error"]);
                }

                ?>
                <table class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if(isset($_SESSION["mensaje"]))
                            {
                                echo '<div class="alert alert-success">';
                                echo $_SESSION["mensaje"];
                                echo '</div>';

                                unset($_SESSION["mensaje"]);
                            }

                        while($fila = $resultado->fetch_assoc())
                        {
                            echo "<tr>";

                            echo "<td>" . $fila["id"] . "</td>";
                            echo "<td>" . $fila["nombre"] . "</td>";
                            echo "<td>" . $fila["precio"] . "</td>";
                            
                            echo '<td>';
    
                            echo '<a href="editar.php?id=' . $fila["id"] . '" class="btn btn-warning me-2">
                                    Editar
                                </a>';
                            
                            echo '<a href="eliminar.php?id=' . $fila["id"] . '"
                                    class="btn btn-danger"
                                    onclick="return confirm(\'¿Está seguro de eliminar este producto?\');">
                                    Eliminar
                                </a>';

                            echo '</td>';

                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                    
                </table>

            </div>

        </div>
    </div>

<?php

include "../includes/footer.php";

?>
<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>