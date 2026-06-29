<?php

$correo = $_POST["correo"];

$password = $_POST["password"];

if (

    $correo == "admin@foto.com"

    &&

    $password == "123456"

)

{

    echo "Bienvenido Administrador";

}

else

{

    echo "Correo o contraseña incorrectos";

}