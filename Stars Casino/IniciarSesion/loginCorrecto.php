<?php
session_start(); // Iniciar sesión PHP

include '../conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //El usuario y la contraseña nunca van a estar vacíos
    $correo = $_POST['correo'];
    $password = $_POST['contraseña'];
    $loginCorrecto = false;

    //Código comprobación login en la BD
    $ins = "SELECT * FROM usuarios WHERE Correo = '".$correo."' AND
         Contraseña = '".$password."'";

    $res = mysqli_query($con,$ins);

    if($res){
        // Cookies para almacenar los datos del usuario
        if(mysqli_num_rows($res) > 0){ //Si la consulta es correcta y nos devuelve algún registro, el usuario existe
            $loginCorrecto = true;
            // Guardar datos de usuario en variables de sesión
            $_SESSION['correo_user'] = $correo;
            $_SESSION['rol'] = "user"; // Suponiendo que todos los usuarios tienen el rol de "user"


        }else{
            echo "<html>";
            echo "<head>";
            echo "<title>ERROR LOGIN</title>";
            echo "<style>";
            echo "h2 { color: white; }";
            echo ".container { 
                background-color: red;
                border: solid 3px;
                padding: 2%;
            }";
            echo "</style>";
            echo "</head>";
            echo "<body>";
            echo "<div class=\"container\">";
            echo "<h2>EL EMAIL O LA CONTRASEÑA SON INCORRECTOS</h2>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    }
    
    //Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    if($loginCorrecto){
        header("Location: ../pantallaPrincipal.php");
        exit();
    }
}

?>
