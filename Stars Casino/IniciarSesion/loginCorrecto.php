<?php

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
        if(mysqli_num_rows($res) > 0){ //Si la consulta es correcta y nos devuelve algún registro, el usuario existe
            $loginCorrecto = true;
        }else{
            echo "<h2>EL CORREO O LA CONTRASEÑA SON INCORRECTOS</h2>";
        }
    }
    
    //Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    if($loginCorrecto){
        header("Location: ../pantallaPrincipal.html");
        exit();
    }
}

?>