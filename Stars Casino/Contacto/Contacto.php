<?php

include '../conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //Los datos nunca van a estar vacíos, son todos obligatorios
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $contactoCorrecto = false;

    //Código insertar registro en la BD
    $ins = "INSERT INTO contacto (Nombre, Email, Teléfono, Asunto, Mensaje) VALUES 
        ('$nombre','$email','$telefono','$asunto', '$mensaje')";

    try{
        mysqli_query($con,$ins); //Ejecutamos el insert, si ya existe el contacto muestra un mensaje de error
        $contactoCorrecto = true;
    }catch(Exception $ex){
        echo "<html>";
        echo "<head>";
        echo "<title>ERROR CONTACTO</title>";
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
        echo "<h2>EL CONTACTO YA ESTA REGISTRADO</h2><br>". "<h3><b>ERROR: ".$ex->getMessage()."</b></h3>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }finally{
        //Cerramos la conexión, ocurra o no algún error
        mysqli_close($con);
    }

    //---------------------------------------------------
    //Si el contacto es correcto nos envia a la página de inicio
    if($contactoCorrecto){
        header("Location: ../pantallaPrincipal.php");
        exit();
    }
}

?>