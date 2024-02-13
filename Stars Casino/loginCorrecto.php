<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //El usuario y la contraseña nunca van a estar vacíos
    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];

    //Código comprobación login en la BD


    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    header("Location: inicio.html");
    exit();
}

?>