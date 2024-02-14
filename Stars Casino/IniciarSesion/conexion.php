<?php

//Variables de conexión
$server = "localhost";
$user = "root";
$password = "";
$bd = "starscasinodb";

//Crear conexión
$con = mysqli_connect($server,$user,$password,$bd);

if(!$con){
    die("Fallo de conexion: ".mysqli_connect_error());
}

?>