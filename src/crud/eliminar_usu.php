<?php
include('Conexion.php');
if (isset($_GET['usuario'])) {
        $usuario = $_GET['usuario']; 
        $usu = new Usuarios();
        $usu->elimusu($usuario); 
    } else {
        echo "Parámetro 'usuario' no proporcionado.";
    }

?>