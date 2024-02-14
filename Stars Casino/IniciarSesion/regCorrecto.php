<?php

include '../conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //El correo,la contraseña, el nombre nunca van a estar vacíos
    $correo = $_POST['correo'];
    $password = $_POST['contraseña'];
    $nombre = $_POST['nombre'];

    //Compruebo que el checkbox admin ha sido pulsado, si es asi le asigno el valor 1
    if(isset($_POST['admin'])){
        $admin = 1;
    }else{
        $admin = 0; //En caso contrario, le asigno 0
    }
    $regCorrecto = false;

    //Código insertar registro en la BD
    $ins = "INSERT INTO usuarios (NombreUsuario,Correo,Contraseña,Admin) VALUES 
        ('$nombre','$correo','$password','$admin')";

    $res = mysqli_query($con,$ins);

    if($res){
        $regCorrecto = true;
    }else{
        echo "<h2>EL USUARIO YA ESTA LOGUEADO</h2>"/*. mysqli_error($con)*/;
    }
    
    //Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    if($regCorrecto){
        header("Location: ../inicio.html");
        exit();
    }
}

?>