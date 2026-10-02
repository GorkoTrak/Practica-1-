<?php

session_start();

if(!isset($_SESSION["usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_SESSION["error"]))
{
    echo '<div class="alert alert-danger">';
    echo $_SESSION["error"];
    echo '</div>';

    unset($_SESSION["error"]);
}


include "../includes/header.php";
include "../includes/menu.php";

?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Registrar producto
        </div>

        <div class="card-body">

            <form action="guardar.php" method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nombre del producto
                    </label>

                    <input type="text" name="nombre" class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Precio
                    </label>

                    <input type="number" name="precio" class="form-control">

                </div>

                <button type="submit" class="btn btn-success">
                    Guardar producto
                </button>

            </form>

        </div>
    </div>
</div>

<?php

include "../includes/footer.php";

?>