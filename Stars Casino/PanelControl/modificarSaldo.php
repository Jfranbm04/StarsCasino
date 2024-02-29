<?php
include '../conexion.php'; // Importamos el fichero de conexión con la BD php

if ($_SERVER['REQUEST_METHOD'] == "POST") { // Si el método de nuestro formulario es POST
    
    // Los datos siempre van a tener contenido
    $nombre = $_POST['nombre'];
    $saldo = $_POST['saldo'];

    $saldoCorrecto = false;

    // Código para modificar brawler en la BD
    $ins = "UPDATE usuarios SET Saldo = '$saldo' 
            WHERE NombreUsuario = '$nombre'";

    $res = mysqli_query($con, $ins);

    if ($res) {
        // Verificamos si se afectaron filas (si se modificó algún registro)
        $filasAfectadas = mysqli_affected_rows($con);

        if ($filasAfectadas > 0) {
            $saldoCorrecto = true; // Si el update es correcto, se afectaron filas y el brawler existe en nuestra colección
        } else {
            echo "<html>";
            echo "<head>";
            echo "<title>ERROR MODIFICAR SALDO</title>";
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
            echo "<h2>EL SALDO NO SE PUDO MODIFICAR</h2>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    }

    // Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    // Si el saldo se modificó correctamente, nos envía al panel de control
    if($saldoCorrecto) {
        header("Location: panelControl.html");
        exit();
    }
}
?>