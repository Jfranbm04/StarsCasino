<?php

include 'conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //El usuario y la contraseña nunca van a estar vacíos
    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];
    $loginCorrecto = false;

    //Código comprobación login en la BD
    $ins = "SELECT * FROM usuarios WHERE Correo = '".$usuario."' AND
         Contraseña = '".$password."'";

    $res = mysqli_query($con,$ins);

    if($res){
        if(mysqli_num_rows($res) > 0){
            $loginCorrecto = true;
        }
    }
    
    //Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    if($loginCorrecto){
        header("Location: inicio.html");
        exit();
    }
}

?>