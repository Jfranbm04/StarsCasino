<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){ //Si el método de nuestro formulario es POST
    
    //Los datos siempre van a tener contenido
    $nombre = $_POST['nombre'];
    $calidad = $_POST['calidad'];
    $nivel = $_POST['nivel'];
    $brawlCorrecto = false;

    
    //Verificar si se ha enviado correctamente el archivo de imagen
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        //Obtener los datos de la imagen subida
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tipo = $_FILES['imagen']['type'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];

        //Leer el archivo de imagen en modo binario
        $imagen_binario = file_get_contents($imagen_tmp);



        /* LO DE ARRIBA ES EL PROCESO PARA AÑADIR LA IMAGEN A LA BASE DE DATOS */
         /* Alomejor para que funcione el insert de la imagen, tenemos que crear una carpeta de imagenes donde van a estar todas las imágenes que tengamos.
            Entonces tendríamos que almacenar la ruta del fichero en la base de datos y al recogerlo que acceda a la carpeta de imagenes. 
            He sacao la info de aqui xd:    https://www.youtube.com/watch?v=sMbyhEXBaAI&ab_channel=Gesti%C3%B3nRt24
         */








        //Código insertar brawler en la BD, incluyendo la imagen
        $ins = "INSERT INTO brawler (Nombre, Calidad, Nivel, imagen) VALUES ('$nombre','$calidad','$nivel','$imagen_binario')";

        try {
            mysqli_query($con, $ins); //Ejecutamos el insert, si ya existe el brawler muestra un mensaje de error
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
            //Cerramos la conexión, ocurra o no algún error
            mysqli_close($con);
        }

        //---------------------------------------------------
        //Si el brawler es nuevo en la colección, nos envía al panel de control
        if($brawlCorrecto){
            header("Location: panelControl.html");
            exit();
        }
    } else {
        // Manejar el caso en el que no se envíe una imagen
        echo "No se ha seleccionado ninguna imagen o ha ocurrido un error al subir la imagen.";
        exit;
    }
}
?>
