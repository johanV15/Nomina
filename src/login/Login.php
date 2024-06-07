<?php
session_start();
include('../crud/Conexion.php');

class Login {
    public function validar($user, $pass, $tipo) {
        $pg = Conectar::conec(); 
        $user = pg_escape_string($pg, $user);
        $pass = pg_escape_string($pg, $pass);
        $tipo = pg_escape_string($pg, $tipo);
        
        $sql = "SELECT * FROM usuario WHERE usuario = '$user' AND pass = '$pass' AND tipo = '$tipo'";
        $result = pg_query($pg, $sql);
    
        if ($row = pg_fetch_assoc($result)) {
            $_SESSION['tipo'] = $row['tipo'];
            $_SESSION['usuario'] = $user;

            if ($_SESSION['tipo'] == 'cliente') {
                $id_cliente = $this->getClienteID($pg, $user);
                $_SESSION['id_cliente'] = $id_cliente;
                echo "
                <script type='text/javascript'>
                 Swal.fire({
                 icon : 'success',
                title : 'BIENVENIDO',
                 text :  ' $_SESSION[usuario] al Sistema'
                }).then((result) => {
                     if(result.isConfirmed){
                     window.location='../clientes/cliente.php';
                    }
                }); </script>";
                exit();
            } elseif ($_SESSION['tipo'] == 'admin') {
                echo "
                <script type='text/javascript'>
                 Swal.fire({
                 icon : 'success',
                title : 'BIENVENIDO',
                 text :  ' $_SESSION[usuario] al Sistema'
                }).then((result) => {
                     if(result.isConfirmed){
                     window.location='../admin/admin.php';
                    }
                }); </script>";                exit();
            } elseif ($_SESSION['tipo'] == 'conductor') {
                $id_cond = $this->getConductorID($pg, $user);
                $_SESSION['id_cond'] = $id_cond;
                echo "
                <script type='text/javascript'>
                 Swal.fire({
                 icon : 'success',
                title : 'BIENVENIDO',
                 text :  ' $_SESSION[usuario] al Sistema'
                }).then((result) => {
                     if(result.isConfirmed){
                     window.location='../conductores/conductor.php';
                    }
                }); </script>";                exit();
            }
        } else {
            $_SESSION['usuario'] = NULL;
            echo "
                <script type='text/javascript'>
                 Swal.fire({
                 icon : 'error',
                title : 'ERROR!!',
                 text :  ' el usuario $user o password  no son correctos'
                }).then((result) => {
                     if(result.isConfirmed){
                     window.location='../index.php';
                    }
                });
                </script>";
            exit();
        }
    }

    public function getConductorID($pg, $user) {
        $sql = "SELECT id_cond FROM conductor WHERE usuario = '$user'";
        $result = pg_query($pg, $sql);
        if ($row = pg_fetch_assoc($result)) {
            return $row['id_cond'];
        }
        return null;
    }

    public function getClienteID($pg, $user) {
        $sql = "SELECT id_cliente FROM cliente WHERE usuario = '$user'";
        $result = pg_query($pg, $sql);
        if ($row = pg_fetch_assoc($result)) {
            return $row['id_cliente'];
        }
        return null;
    }
}
?>
