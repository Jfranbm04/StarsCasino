<?php
  //Extraemos los datos del usuario conectado
  include '../conexion.php';

  session_start(); // Iniciar sesión PHP

  //Recibir correo del usuario autenticado
  $correo = $_SESSION['correo_user'];

  //Consulta todos los datos de dicho usuario
  $ins = "SELECT * FROM usuarios WHERE Correo = '$correo'";

  $res = mysqli_query($con,$ins);
  $row = mysqli_fetch_row($res); //Estoy extrayendo el registro completo de la consulta select
  // Liberar recursos
  mysqli_free_result($res);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Juanfran/Jorge" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="diseñoPerfil.css">
    <!-- Icono -->
    <link rel="icon" href="../ImagenesPrincipal/IconoStarsCasino.png" type="image/png">
    <title>Perfil</title>
</head>
<body>
  <a class="volver" href="../pantallaPrincipal.php">VOLVER AL INICIO</a>

  <!-- Formulario-->
  <div class="contact_form">
    <div class="formulario">      
      <!-- Aqui solo se pueden ver tus datos-->
      <form>
      <h1 class="titulo">Perfil</h1> 
      <p>
        <label for="Correo" class="colocar_Correo">Correo</label>
        <input type="email" name="correo" placeholder="Correo" value="<?php echo $row[1]; ?>" readonly>
      </p>

      <p>
        <label for="usuario" class="colocar_usuario">Usuario</label>
        <input type="text" name="usuario" placeholder="Usuario" value="<?php echo $row[0]; ?>" readonly>
      </p>
          
      <p>
        <label for="contraseña" class="colocar_contraseña">Contraseña</label>
        <input type="text" name="contraseña" placeholder="Contraseña" value="<?php echo $row[2]; ?>" readonly>
      </p>
        
      <p>
        <label for="saldo" class="colocar_saldo">Tu saldo</label>
        <input type="number" min="1" name="saldo" placeholder="Saldo" value="<?php echo $row[4]; ?>" readonly>
      </p> 
      </form>
    </div>  
  </div>

</body>
</html>