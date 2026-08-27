<?php

session_start();

include "../config/conexion.php";


if (!isset($_POST["sesion_id"])) {

    $_SESSION["error"] = "Sesión no especificada.";

    header("Location: sesiones.php");
    exit();
}


$sesion_id = $_POST["sesion_id"];


if (!is_numeric($sesion_id)) {

    $_SESSION["error"] = "Sesión no válida.";

    header("Location: sesiones.php");
    exit();
}


if (!isset($_FILES["fotos"])) {

    $_SESSION["error"] = "No se seleccionaron fotografías.";

    header("Location: sesiones.php");
    exit();
}


$descripcion = $_POST["descripcion"] ?? "";


$carpeta = "../uploads/sesiones/";


if (!is_dir($carpeta)) {

    mkdir($carpeta, 0777, true);
}


$permitidas = [
    "jpg",
    "jpeg",
    "png",
    "webp",
    "gif"
];


$archivos = $_FILES["fotos"];

$subidas = 0;


for ($i = 0; $i < count($archivos["name"]); $i++) {

    if ($archivos["error"][$i] !== UPLOAD_ERR_OK) {
        continue;
    }


    $nombreOriginal = $archivos["name"][$i];


    $extension = strtolower(
        pathinfo(
            $nombreOriginal,
            PATHINFO_EXTENSION
        )
    );


    if (!in_array($extension, $permitidas)) {
        continue;
    }


    $nombre = "ses_" .
              $sesion_id . "_" .
              time() . "_" .
              $i . "." .
              $extension;


    $destino = $carpeta . $nombre;


    if (
        move_uploaded_file(
            $archivos["tmp_name"][$i],
            $destino
        )
    ) {

        $ruta = "uploads/sesiones/" . $nombre;


        $sql = "INSERT INTO sesion_fotos
                (sesion_id, archivo, descripcion)
                VALUES (?, ?, ?)";


        $stmt = $conexion->prepare($sql);


        $stmt->bind_param(
            "iss",
            $sesion_id,
            $ruta,
            $descripcion
        );


        if ($stmt->execute()) {

            $subidas++;

        }


        $stmt->close();
    }
}


if ($subidas > 0) {

    $_SESSION["mensaje"] =
        $subidas .
        " fotografía(s) subida(s) correctamente.";

} else {

    $_SESSION["error"] =
        "No se pudo subir ninguna fotografía.";
}


header("Location: sesiones.php");
exit();

?>