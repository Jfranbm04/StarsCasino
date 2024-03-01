<?php

include '../conexion.php'; // Importamos el fichero de conexión con la BD php

if ($_SERVER['REQUEST_METHOD'] == "POST") { // Si el método de nuestro formulario es POST
    
    //El correo es obligatorio introducirlo
    $correo = $_POST['correo'];
    $usuarioCorrecto = false;
    $datosCorrectos = false;

    //Inicializamos la instruccion primero, para poder usarla despues
    $ins = "";

    //Comprobar que los datos son correctos
    if(isset($_POST['nombre']) && $_POST['nombre'] !== '' && isset($_POST['saldo']) && $_POST['saldo'] !== ''){
        $nombre = $_POST['nombre'];
        $saldo = $_POST['saldo'];
        $ins = "UPDATE usuarios SET NombreUsuario = '$nombre', Saldo = '$saldo' 
                WHERE Correo = '$correo'";
        $datosCorrectos = true;
    }else{
        if(isset($_POST['nombre']) && $_POST['nombre'] !== ''){
            $nombre = $_POST['nombre'];
            $ins = "UPDATE usuarios SET NombreUsuario = '$nombre'
                    WHERE Correo = '$correo'";
            $datosCorrectos = true;
        }else{
            if(isset($_POST['saldo']) && $_POST['saldo'] !== ''){
                $saldo = $_POST['saldo'];
                $ins = "UPDATE usuarios SET Saldo = '$saldo' 
                        WHERE Correo = '$correo'";
                $datosCorrectos = true;
            }
        }
    }


    if($datosCorrectos){
        //Ejecutamos la consulta dependiendo de los datos que quiera modificar el usuario
        $res = mysqli_query($con, $ins);
    
        if ($res) {
            // Verificamos si se afectaron filas (si se modificó algún registro)
            $filasAfectadas = mysqli_affected_rows($con);

            if ($filasAfectadas > 0) {
                $usuarioCorrecto = true; // Si el update es correcto, se afectaron filas y el brawler existe en nuestra colección
            } else {
                echo "<html>";
                echo "<head>";
                echo "<title>ERROR MODIFICAR USUARIO</title>";
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
                echo "<h2>EL USUARIO NO EXISTE</h2>";
                echo "</div>";
                echo "</body>";
                echo "</html>";
            }
        }

    }else{

        echo "<html>";
        echo "<head>";
        echo "<title>ERROR MODIFICAR USUARIO</title>";
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
        echo "<h2>DEBE INTRODUCIR UN SALDO O UN NOMBRE A MODIFICAR</h2>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }

    // Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    // Si el saldo se modificó correctamente, nos envía al panel de control
    if($usuarioCorrecto) {
        header("Location: panelControl.html");
        exit();
    }
}
?>