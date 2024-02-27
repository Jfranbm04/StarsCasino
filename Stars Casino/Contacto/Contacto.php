<?php

include '../conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //El correo,la contraseña, el nombre nunca van a estar vacíos
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    //Compruebo que el checkbox admin ha sido pulsado, si es asi le asigno el valor 1
    if(isset($_POST['admin'])){
        $admin = 1;
    }else{
        $admin = 0; //En caso contrario, le asigno 0
    }
    $regCorrecto = false;

    //Código insertar registro en la BD
    $ins = "INSERT INTO contacto (Nombre, Email, Teléfono, Asunto, Mensaje) VALUES 
        ('$nombre','$email','$telefono','$asunto', '$mensaje')";

    try{
        mysqli_query($con,$ins); //Ejecutamos el insert, si ya existe el usuario muestra un mensaje de error
        $regCorrecto = true;
    }catch(Exception $ex){
        echo "<h2>EL USUARIO YA ESTA LOGUEADO</h2><br>". $ex->getMessage();
    }finally{
        //Cerramos la conexión, ocurra o no algún error
        mysqli_close($con);
    }

    //---------------------------------------------------
    //Si el login es correcto nos envia a la página de inicio
    if($regCorrecto){
        header("Location: ../pantallaPrincipal.html");
        exit();
    }
}

?>