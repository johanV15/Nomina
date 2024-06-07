<?php
include('Conexion.php');
$clie = new Clientes();
if(isset($_POST['grabar']) && $_POST['grabar'] =='si'){
$clie->editarclie($_REQUEST['id_cliente'],$_REQUEST['nombre'],$_REQUEST['apellido'],$_REQUEST['direccion'],$_REQUEST['genero'],$_REQUEST['nacionalidad'],$_REQUEST['usuario']);
exit();
}
$cliente=$clie->get_idc($_GET['id']);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sw/dist/sweetalert2.min.css">

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
        <h1>EDITAR CLIENTES</h1>
        <div class="card-body">
            <form name="form" action="editar_clientes.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="id_cond">IDENTIFICACION</label>
                        <input type="hidden" name="grabar" value="si">
                        <input type="number" name="id_cliente" class="form-control" value="<?php echo $_GET['id'];?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control"
                            value="<?php echo $cliente[0]['nombre']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" class="form-control"
                            value="<?php echo $cliente[0]['apellido']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" class="form-control"
                            value="<?php echo $cliente[0]['direccion']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="genero">Género:</label>
                        <input type="text" name="genero" class="form-control"
                            value="<?php echo $cliente[0]['genero']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="nacionalidad">Nacionalidad:</label>
                        <input type="text" name="nacionalidad" class="form-control"
                            value="<?php echo $cliente[0]['nacionalidad']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" class="form-control"
                            value="<?php echo $cliente[0]['usuario']; ?>"readonly><br>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                    </div>
                </div>
            </form>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="../sw/dist/sweetalert2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>