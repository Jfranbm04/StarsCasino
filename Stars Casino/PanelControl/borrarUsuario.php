<?php

include '../conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
    //El nombre nunca va a estar vacio
    $nombre = $_POST['nombre'];
    $borradoCorrecto = false;

    //Código comprobación login en la BD
    $ins = "DELETE FROM usuarios WHERE NombreUsuario = '$nombre'";

    $res = mysqli_query($con,$ins);

    if($res){
        // Verificamos si se afectaron filas (si se borró algún registro)
        $filasAfectadas = mysqli_affected_rows($con);
    
        if ($filasAfectadas > 0) {
            $borradoCorrecto = true; // Si el delete es correcto, se afectaron filas y el brawler existe en nuestra colección
        } else {
            echo "<html>";
            echo "<head>";
            echo "<title>ERROR BORRAR USUARIO</title>";
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

    // Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    //Si el borrado es correcto nos envia al panel de Control
    if($borradoCorrecto){
        header("Location: panelControl.html");
        exit();
    }
}

?>