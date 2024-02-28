
<?php

include 'conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //Los datos nunca van a estar vacíos, son todos obligatorios
    $user = $_POST['usuario'];
    $psw = $_POST['contraseña'];
    $saldo = $_POST['saldo'];
    $perfilCorrecto = false;

    //Código update usuario en la BD
    $ins = "UPDATE usuarios SET NombreUsuario = '$user', Contraseña = '$psw', Saldo = '$saldo'
            WHERE Correo = '$correo'"; //Falta la variable "$correo", necesitamos tenerla por parametro

    $res = mysqli_query($con,$ins); //Ejecutamos el update, si es correcto se vera algun registro afectado
    //Lo almacenamos en la variable "$res", es un boleano; comprobar con if si ha ido todo gucci

    //COPIAR CODIGO modBrawler.php
    //.....
    $perfilCorrecto = true;
    
    //Cerramos la conexión, ocurra o no algún error
    mysqli_close($con);

    //---------------------------------------------------
    //Si el perfil es correcto nos envia a la página principal
    if($perfilCorrecto){
        header("Location: pantallaPrincipal.php");
        exit();
    }
}

?>