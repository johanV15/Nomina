<?php
include('Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'cliente') {
        insertarCliente();
    } elseif ($_POST['tipo'] == 'conductor') {
        insertarConductor();
    }
}

function insertarCliente()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pg = Conectar::conec();
        $id_cliente = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $genero = $_POST['genero'];
        $nacionalidad = $_POST['nacionalidad'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['pass'];
        $confirmar_contrasena = $_POST['pass2'];
        $tipo = $_POST['tipo'];
        $telefono = $_POST['telefono'];
        $query = "SELECT usuario FROM usuario WHERE usuario = $1";
        $result = pg_query_params($pg, $query, array($usuario));

        if (pg_num_rows($result) > 0) {
            echo "El usuario ya existe. Por favor, elige otro nombre de usuario.";
        } elseif ($contrasena != $confirmar_contrasena) {
            echo "Las contraseñas no coinciden.";
        } else {
            $query = "INSERT INTO usuario (usuario, pass, tipo, correo) VALUES ($1, $2, $3, $4)";
            $result = pg_query_params($pg, $query, array($usuario, $contrasena, $tipo, $correo));

            if ($result) {
                $clientes = new Clientes();
                $clientes->insertclie($id_cliente, $nombre, $apellido, $direccion, $genero, $nacionalidad, $usuario);
                $clientes->inserttelc($id_cliente, $telefono);
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
}

function insertarConductor()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pg = Conectar::conec();
        $id_cond = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $genero = $_POST['genero'];
        $nacionalidad = $_POST['nacionalidad'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['pass'];
        $confirmar_contrasena = $_POST['pass2'];
        $tipo = $_POST['tipo'];
        $telefono = $_POST['telefono'];
        $query = "SELECT usuario FROM usuario WHERE usuario = $1";
        $result = pg_query_params($pg, $query, array($usuario));

        if (pg_num_rows($result) > 0) {
            echo "El usuario ya existe. Por favor, elige otro nombre de usuario.";
        } elseif ($contrasena != $confirmar_contrasena) {
            echo "Las contraseñas no coinciden.";
        } else {
            $query = "INSERT INTO usuario (usuario, pass, tipo, correo) VALUES ($1, $2, $3, $4)";
            $result = pg_query_params($pg, $query, array($usuario, $contrasena, $tipo, $correo));

            if ($result) {
                $conductores = new Conductores();
                $conductores->insertcond($id_cond, $nombre, $apellido, $direccion, $genero, $nacionalidad, $usuario);
                $conductores->inserttelcond($id_cond, $telefono);
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
}
function insertarVehiculo()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pg = Conectar::conec();
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $id_serv = $_POST['id_serv'];
        $id_cond = $_SESSION['id_cond'];

        echo "placa: " . $placa . "<br>";
        echo "modelo: " . $modelo . "<br>";
        echo "id_serv: " . $id_serv . "<br>";
        echo "id_cond: " . $id_cond . "<br>";

        $query = "INSERT INTO vehiculo (placa, modelo, id_serv, id_cond) VALUES ($1, $2, $3, $4)";
        $result = pg_query_params($pg, $query, array($placa, $modelo, $id_serv, $id_cond));

        if ($result) {
            $vehi = new Vehiculos();
            $vehi->insertarve($placa, $modelo, $id_serv, $id_cond);
            echo "Vehículo insertado correctamente.";
        } else {
            echo "Error al registrar el vehículo.";
        }
    }
}

?>