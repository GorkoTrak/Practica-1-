<?php

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">

    <div class="container">

        <a class="navbar-brand" href="/Practica-1/index.php">
            Liz Fotografía
        </a>

        <ul class="navbar-nav gap-2">

            <li class="nav-item">
                <a class="nav-link" href="/Practica-1/index.php">
                    Inicio
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/Practica-1/usuarios/usuarios.php">
                    Usuarios
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/Practica-1/clientes/clientes.php">
                    Clientes
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/Practica-1/productos/productos.php">
                    Productos
                </a>
            </li>
            
            <?php if($_SESSION["rol"] == "administrador"): ?>

                <li class="nav-item">
                    <a class="nav-link" href="/Practica-1/usuarios/formulario.php">
                        Registrar usuario
                    </a>
                </li>

            <?php endif; ?>

            <li class="nav-item">
                <a class="btn btn-secondary" href="/Practica-1/auth/logout.php">
                    Cerrar sesión
                </a>
            </li>

        </ul>

    </div>

</nav>