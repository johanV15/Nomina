<?php
session_start();
include('Conexion.php');

$vehi = new Vehiculos();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $id_serv = $_POST['id_serv'];
    $id_cond = $_SESSION['id_cond'];
    $vehi->insertarve($placa, $modelo, $id_serv, $id_cond);
}
?>