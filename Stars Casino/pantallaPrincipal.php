<?php
session_start(); // Iniciar sesión PHP si no lo has hecho antes

// Almacenamos los datos del usuario que ha entrado
$correo = $_SESSION['correo_user'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta author="Jorge y Juanfran">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icono -->
    <link rel="icon" href="ImagenesPrincipal/IconoStarsCasino.png" type="image/png">
    <link rel="stylesheet" href="diseñoPrincipal.css">
    <title>Pantalla Principal</title>
    <style>
        @font-face {
            font-family: 'LilitaOne';
            src: url('Fuentes/Lilita_One/LilitaOne-Regular.ttf');
        }

        .cookies {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            font-family: 'LilitaOne'; 
            margin-top: 140px;
            margin-right: 20px;
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>


</head>
<body>
    <!-- Portada página -->
    <header class="header">
        <div class="logoWeb">
            <img src="ImagenesPrincipal\Star_Casino_Logo.jpeg" alt="Logo del casino">
        </div>

        <!--Mostrar Cookies-->
        <div class="cookies">
        <?php
            // Mostrar la información del usuario
            echo "<p style='font-size: 18px;'>Bienvenido, $correo</p>";
            if (strcmp($rol,"admin") == 0) { //Funcion equals, si nos devuelve un 0, ha entrado un administrador
                echo "<p style='font-size: 18px;'>Rol: Administrador</p>";

            } else { //En caso contrario, es un usuario sin privilegios
                echo "<p style='font-size: 18px;'>Rol: Usuario</p>";
                
            }
        ?>
    </div>

      <div class="letrero">
          <img src="ImagenesPrincipal/starsCasinoLetrero.png" alt="Letrero del casino">
      </div>
    </header>
    
    <!-- Barra superior nav -->
    <nav class="menu">
        <ul>
            <li><a href="Perfil.php"><!-- jorge guapo -->PERFIL</a></li>    
            <li><a href="Contacto\Contacto.html">CONTACTO</a></li>
            <!-- SI EL USUARIO QUE HA INGRESADO ES UN ADMINISTRADOR, PODRA VER EL PANEL DE CONTROL-->
            <?php 
                if(strcmp($rol,"admin") == 0){
                    echo "<li><a href=\"PanelControl/panelControl.html\">PANEL DE CONTROL</a></li>";
                }
            ?>
            <li><a href="EntradaScreen.html">CERRAR SESION</a></li>
        </ul> 
    </nav>

	<main>
		<!-- Contenido de la página -->

    <!-- Coleccion de brawlers -->
    <h1>NUESTRA COLECCIÓN DE BRAWLERS</h1>
    
    <div class="container">
       
        <?php
            // Conexión a la base de datos y consulta de los personajes
            include 'conexion.php';

            $sql = "SELECT * FROM brawler";
            $result = $con->query($sql);

            // Itero sobre los resultados y muestro cada tarjeta de personaje
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<h4>' . $row["Nombre"] . '</h4>';
                    echo '<p>Calidad: ' . $row["Calidad"] . '</p>';
                    echo '<p>Nivel: ' . $row["Nivel"] . '</p>';

                    // Aqui podríamos añadir la imagen del brawler 
                    // Mostrar la imagen del brawler
                     if(isset($row['imagen'])){
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'" alt="'.$row['Nombre'].'">';
                     }
                    

                    echo '</div>';
                }
            } else {
                echo "No hay brawlers en la colección";
            }

            // Cerrar conexión
            if ($con) {
                $con->close();
            }
        ?>
 
    </div>

	</main>

  <!-- Footer -->
	<footer>
        <div class="quienesSomos">QUIENES SOMOS</div>
        <div class="redes-sociales">
          <a href="https://www.facebook.com/brawlstars"><i class="fab fa-facebook"></i></a>
          <a href="https://twitter.com/brawlstars"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/BrawlStars"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/company/supercell"><i class="fab fa-linkedin"></i></a>
        </div>
        <p class="Copyright">Copyright @2024 | Supercell Studios</a></p>
  </footer>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</body>
</html>