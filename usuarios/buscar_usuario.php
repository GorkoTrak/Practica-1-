<?php

include "../config/conexion.php";

$sql = "SELECT * FROM usuarios";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {

    echo "Nombre: " . $fila["nombre"];

    echo "<br>";

    echo "Correo: " . $fila["correo"];

    echo "<hr>";
}