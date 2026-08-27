<?php

session_start();

include "../config/conexion.php";

if (!isset($_GET["id"])) {
    $_SESSION["error"] = "Fotografía no especificada.";
    header("Location: sesiones.php");
    exit();
}

$id = $_GET["id"];

/* Buscar la fotografía */
$sql = "SELECT archivo, sesion_id
        FROM sesion_fotos
        WHERE id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {

    $_SESSION["error"] = "La fotografía no existe.";

    header("Location: sesiones.php");
    exit();
}

$foto = $resultado->fetch_assoc();

$stmt->close();


/* Eliminar archivo físico */

$rutaArchivo = "../" . $foto["archivo"];

if (file_exists($rutaArchivo)) {
    unlink($rutaArchivo);
}


/* Eliminar registro de la base de datos */

$sql = "DELETE FROM sesion_fotos
        WHERE id = ?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$stmt->close();


$_SESSION["mensaje"] =
    "Fotografía eliminada correctamente.";


header("Location: sesiones.php");

exit();

?>