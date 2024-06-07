<?php
include('Conexion.php');
$usu = new Usuarios();

if (isset($_POST['grabar']) && $_POST['grabar'] == 'si') {
    $usuarioAnterior = $_REQUEST['usuario_anterior'];
    $usu->editarusu($_REQUEST['usuario'], $_REQUEST['pass'], $_REQUEST['tipo'], $_REQUEST['correo'], $usuarioAnterior);
    exit();
}

$usuario = $usu->get_usu($_GET['usuario']);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aventureros SA</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../admin/admin.php">Volver</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>EDITAR USUARIOS</h1>
        <div class="card-body">
            <form action="editar_usua.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="id_cond">Usuario:</label>
                        <input type="hidden" name="grabar" value="si">
                        <input type="hidden" name="usuario_anterior" value="<?php echo $_GET['usuario']; ?>">
                        <input type="text" name="usuario" class="form-control" value="<?php echo $_GET['usuario']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Contraseña:</label>
                        <input type="text" name="pass" class="form-control" value="<?php echo $usuario[0]['pass']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido">Correo:</label>
                        <input type="email" name="correo" class="form-control" value="<?php echo $usuario[0]['correo']; ?>"><br>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
