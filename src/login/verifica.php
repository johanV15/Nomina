<?php
include('Login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'];
    $pass = $_POST['pass'];
    $tipo = $_POST['tipo'];

    $log = new Login();
    $log->validar($user, $pass, $tipo);
}
?>
