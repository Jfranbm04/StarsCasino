
<?php

include 'conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //Los datos nunca van a estar vacíos, son todos obligatorios
    $user = $_POST['usuario'];
    $psw = $_POST['contraseña'];
    $saldo = $_POST['saldo'];
    $perfilCorrecto = false;

    //Código insertar registro en la BD
    $ins = "ey";
    echo $ins;

    

    
    mysqli_query($con,$ins); //Ejecutamos el update, si ya existe el contacto muestra un mensaje de error
    $perfilCorrecto = true;
    
    //Cerramos la conexión, ocurra o no algún error
    mysqli_close($con);

    //---------------------------------------------------
    //Si el contacto es correcto nos envia a la página de inicio
    if($perfilCorrecto){
        header("Location: ../pantallaPrincipal.php");
        exit();
    }
}

?>