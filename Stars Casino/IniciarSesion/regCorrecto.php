<?php

session_start(); // Iniciar sesión PHP

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

    try{
        mysqli_query($con,$ins); //Ejecutamos el insert, si ya existe el usuario muestra un mensaje de error
        $regCorrecto = true;
        // Guardar datos de usuario en variables de sesión
        $_SESSION['correo_user'] = $correo;
        //Rol de usuario
        $rol = "user";
        if($admin == 1){
            $rol = "admin";
        }
        $_SESSION['rol'] = $rol; // Le asignamos el rol que tenga ese usuario
        
    }catch(Exception $ex){
        echo "<html>";
        echo "<head>";
        echo "<title>ERROR REGISTRO</title>";
        echo "<style>";
        echo "h2,h3 { color: white; }";
        echo ".container { 
            background-color: red;
            border: solid 3px;
            padding: 2%;
        }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class=\"container\">";
        echo "<h2>EL USUARIO YA ESTA LOGUEADO</h2><br>". "<h3><b>ERROR: ".$ex->getMessage()."</b></h3>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        
    }finally{
        //Cerramos la conexión, ocurra o no algún error
        mysqli_close($con);
    }

    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    if($regCorrecto){
        header("Location: ../pantallaPrincipal.php");
        exit();
    }
}

?>
