<?php
session_start();
include('../crud/Conexion.php');

        $pg = Conectar::conec(); 
        $usuario = $_POST['usuario'];
        $pass = $_POST['new_pass'];
        
        $sql = "UPDATE usuario set pass='$pass' WHERE usuario='$usuario'";
        $result = pg_query($pg, $sql);
        echo "
    <script type='text/javascript'>
    Swal.fire({
       icon : 'success',
       title : 'Operacion Exitosa!!',
       text :  'Contraseña editada Correctamente'
    }).then((result) => {
        if(result.isConfirmed){
            window.location='../index.php';
        }
    });
    </script>";
        exit();
?>
