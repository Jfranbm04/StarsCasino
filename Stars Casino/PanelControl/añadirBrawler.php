<?php
include '../conexion.php'; //Importamos el fichero de conexion con la BD php

if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el metodo de nuestro formulario es POST
    
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

    // Código insertar brawler en la BD
    $ins = "INSERT INTO brawler (Nombre, Calidad, Nivel, imagen) VALUES ('$nombre', '$calidad', '$nivel', '$imagenBinario')";

    try {
        mysqli_query($con, $ins); // Ejecutamos el insert, si ya existe el brawler muestra un mensaje de error
        $brawlCorrecto = true;
    } catch(Exception $ex) {
        echo "<html>";
        echo "<head>";
        echo "<title>ERROR AÑADIR BRAWLER</title>";
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
        echo "<h2>EL BRAWLER YA ESTA EN LA COLECCIÓN</h2><br>". "<h3><b>ERROR: ".$ex->getMessage()."</b></h3>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } finally {
        // Cerramos la conexión, ocurra o no algún error
        mysqli_close($con);
    }

    //---------------------------------------------------
    // Si el brawler es nuevo en la colección, nos envía al panel de control
    if($brawlCorrecto) {
        header("Location: panelControl.html");
        exit();
    }
}
?>
