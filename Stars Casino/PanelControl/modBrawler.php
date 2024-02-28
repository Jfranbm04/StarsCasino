<?php
include '../conexion.php'; // Importamos el fichero de conexión con la BD php

if ($_SERVER['REQUEST_METHOD'] == "POST") { // Si el método de nuestro formulario es POST
    
    // Los datos siempre van a tener contenido
    $nombre = $_POST['nombre'];
    $calidad = $_POST['calidad'];
    $nivel = $_POST['nivel'];
    $brawlCorrecto = false;

    // Obtener información de la imagen
    $nombreImagen = $_FILES['imagen']['name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamañoImagen = $_FILES['imagen']['size'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];

    // Leer el contenido de la imagen en bytes
    $imagenBinario = addslashes(file_get_contents($imagenTmp));

    // Código para modificar brawler en la BD
    $ins = "UPDATE brawler SET Calidad = '$calidad', Nivel = '$nivel', imagen = '$imagenBinario' 
            WHERE Nombre = '$nombre'";

    $res = mysqli_query($con, $ins);

    if ($res) {
        // Verificamos si se afectaron filas (si se modificó algún registro)
        $filasAfectadas = mysqli_affected_rows($con);

        if ($filasAfectadas > 0) {
            $brawlCorrecto = true; // Si el update es correcto, se afectaron filas y el brawler existe en nuestra colección
        } else {
            echo "<html>";
            echo "<head>";
            echo "<title>ERROR MODIFICAR BRAWLER</title>";
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
            echo "<h2>EL BRAWLER NO EXISTE EN LA COLECCIÓN</h2>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    }

    // Cerramos la conexión
    mysqli_close($con);

    //---------------------------------------------------
    // Si el brawler se modificó correctamente, nos envía al panel de control
    if($brawlCorrecto) {
        header("Location: panelControl.html");
        exit();
    }
}
?>