<?php
include ('Conexion.php');

        $clie = new Clientes();
        $clie->elimc($_GET['id']);
        $cond = new Conductores();
        $cond->elimcond($_GET['id']);
    


?>