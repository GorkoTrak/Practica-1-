<?php

session_start();

include "../config/conexion.php";

?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/menu.php"; ?>


<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Sesiones Fotográficas</h2>

        <a href="formulario.php" class="btn btn-primary">
            Nueva sesión
        </a>

    </div>


    <!-- Mensajes -->

    <?php if(isset($_SESSION["mensaje"])): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?php
            echo $_SESSION["mensaje"];
            unset($_SESSION["mensaje"]);
            ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if(isset($_SESSION["error"])): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?php
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
            ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <!-- Tabla de sesiones -->

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Cliente</th>

                    <th>Fecha</th>

                    <th>Hora</th>

                    <th>Tipo</th>

                    <th>Estado</th>

                    <th>Notas</th>

                    <th>Fotos</th>

                    <th>Acciones</th>

                </tr>

            </thead>


            <tbody>

            <?php

            $sql = "SELECT
                        sesiones.id,
                        sesiones.cliente_id,
                        sesiones.fecha,
                        sesiones.hora,
                        sesiones.tipo,
                        sesiones.estado,
                        sesiones.notas,
                        clientes.nombre,
                        clientes.apellido
                    FROM sesiones
                    INNER JOIN clientes
                    ON sesiones.cliente_id = clientes.id
                    ORDER BY sesiones.fecha DESC, sesiones.hora DESC";

            $resultado = $conexion->query($sql);


            if($resultado && $resultado->num_rows > 0):

                while($fila = $resultado->fetch_assoc()):

            ?>

                <tr>

                    <td>
                        <?php echo $fila["id"]; ?>
                    </td>


                    <td>

                        <?php

                        echo htmlspecialchars(
                            $fila["nombre"] . " " . $fila["apellido"]
                        );

                        ?>

                    </td>


                    <td>
                        <?php echo $fila["fecha"]; ?>
                    </td>


                    <td>
                        <?php echo $fila["hora"]; ?>
                    </td>


                    <td>
                        <?php echo htmlspecialchars($fila["tipo"]); ?>
                    </td>


                    <td>

                        <?php

                        $claseEstado = "bg-warning text-dark";

                        if($fila["estado"] == "Confirmada")
                        {
                            $claseEstado = "bg-primary";
                        }

                        if($fila["estado"] == "Completada")
                        {
                            $claseEstado = "bg-success";
                        }

                        if($fila["estado"] == "Cancelada")
                        {
                            $claseEstado = "bg-danger";
                        }

                        ?>

                        <span class="badge <?php echo $claseEstado; ?>">

                            <?php echo htmlspecialchars($fila["estado"]); ?>

                        </span>

                    </td>


                    <td>

                        <?php

                        echo htmlspecialchars(
                            $fila["notas"] ?? ""
                        );

                        ?>

                    </td>


                    <!-- FOTOS -->

                    <td>

                        <?php

                        $sesionId = $fila["id"];

                        $sqlFotos = "SELECT *
                                     FROM sesion_fotos
                                     WHERE sesion_id = ?
                                     ORDER BY fecha_subida DESC";

                        $stmtFotos = $conexion->prepare($sqlFotos);

                        $stmtFotos->bind_param(
                            "i",
                            $sesionId
                        );

                        $stmtFotos->execute();

                        $resultadoFotos = $stmtFotos->get_result();

                        $cantidadFotos = $resultadoFotos->num_rows;

                        ?>

                        <button
                            type="button"
                            class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalFotos<?php echo $sesionId; ?>"
                        >

                            Fotos
                            (<?php echo $cantidadFotos; ?>)

                        </button>

                        <?php

                        $stmtFotos->close();

                        ?>

                    </td>


                    <!-- ACCIONES -->

                    <td>

                        <a
                            href="editar.php?id=<?php echo $fila["id"]; ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Editar
                        </a>


                        <a
                            href="eliminar.php?id=<?php echo $fila["id"]; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Está seguro de eliminar esta sesión?');"
                        >
                            Eliminar
                        </a>

                    </td>

                </tr>


                <!-- MODAL DE FOTOS -->

                <div
                    class="modal fade"
                    id="modalFotos<?php echo $sesionId; ?>"
                    tabindex="-1"
                    aria-hidden="true"
                >

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">


                            <div class="modal-header">

                                <h5 class="modal-title">

                                    Fotografías de la sesión

                                    <?php echo $fila["fecha"]; ?>

                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                ></button>

                            </div>


                            <div class="modal-body">


                                <!-- FORMULARIO PARA SUBIR -->

                                <form
                                    action="subir_fotos.php"
                                    method="POST"
                                    enctype="multipart/form-data"
                                    class="mb-4"
                                >

                                    <input
                                        type="hidden"
                                        name="sesion_id"
                                        value="<?php echo $sesionId; ?>"
                                    >


                                    <div class="mb-3">

                                        <label class="form-label">
                                            Seleccionar fotografías
                                        </label>

                                        <input
                                            type="file"
                                            name="fotos[]"
                                            class="form-control"
                                            accept="image/*"
                                            multiple
                                            required
                                        >

                                    </div>


                                    <div class="mb-3">

                                        <label class="form-label">
                                            Descripción
                                        </label>

                                        <input
                                            type="text"
                                            name="descripcion"
                                            class="form-control"
                                            placeholder="Descripción opcional"
                                        >

                                    </div>


                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Subir fotografías
                                    </button>

                                </form>


                                <hr>


                                <!-- FOTOGRAFÍAS EXISTENTES -->

                                <h5 class="mb-3">
                                    Fotografías guardadas
                                </h5>


                                <div class="row">


                                <?php

                                $sqlFotos = "SELECT *
                                             FROM sesion_fotos
                                             WHERE sesion_id = ?
                                             ORDER BY fecha_subida DESC";

                                $stmtFotos = $conexion->prepare($sqlFotos);

                                $stmtFotos->bind_param(
                                    "i",
                                    $sesionId
                                );

                                $stmtFotos->execute();

                                $resultadoFotos =
                                    $stmtFotos->get_result();


                                if($resultadoFotos->num_rows > 0):

                                    while($foto = $resultadoFotos->fetch_assoc()):

                                ?>

                                    <div class="col-md-4 mb-3">

                                        <div class="card">

                                            <img
                                                src="../<?php echo htmlspecialchars($foto["archivo"]); ?>"
                                                class="card-img-top"
                                                style="height:200px; object-fit:cover;"
                                                alt="Fotografía"
                                            >


                                            <div class="card-body">

                                                <?php if(!empty($foto["descripcion"])): ?>

                                                    <p class="card-text">

                                                        <?php

                                                        echo htmlspecialchars(
                                                            $foto["descripcion"]
                                                        );

                                                        ?>

                                                    </p>

                                                <?php endif; ?>


                                                    <small class="text-muted">

                                                        <?php
                                                        echo $foto["fecha_subida"];
                                                        ?>

                                                    </small>

                                                    <br>

                                                    <a
                                                        href="eliminar_foto.php?id=<?php echo $foto["id"]; ?>"
                                                        class="btn btn-danger btn-sm mt-2"
                                                        onclick="return confirm('¿Está seguro de eliminar esta fotografía?');"
                                                    >
                                                        Eliminar
                                                    </a>

                                            </div>

                                        </div>

                                    </div>


                                <?php

                                    endwhile;

                                else:

                                ?>

                                    <div class="col-12">

                                        <p class="text-muted">

                                            Esta sesión todavía no tiene fotografías.

                                        </p>

                                    </div>

                                <?php

                                endif;

                                $stmtFotos->close();

                                ?>

                                </div>

                            </div>


                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Cerrar
                                </button>

                            </div>

                        </div>

                    </div>

                </div>


            <?php

                endwhile;

            else:

            ?>

                <tr>

                    <td
                        colspan="9"
                        class="text-center"
                    >

                        No hay sesiones registradas.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<?php include "../includes/footer.php"; ?>