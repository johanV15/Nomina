<?php
include('Conexion.php');
$reg = new Registros();
if(isset($_POST['grabar']) && $_POST['grabar'] =='si'){
$reg->editarreg($_REQUEST['id_reg'],$_REQUEST['val_servicio'], $_REQUEST['medio_pago'], $_REQUEST['fecha'], $_REQUEST['estado']);
exit();
}
$reg_serv=$reg->get_id_reg($_GET['id_reg']);
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
        <h1>EDITAR Registros</h1>
        <div class="card-body">
            <form name="form" action="editar_reg.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="id_cat">ID:</label>
                        <input type="hidden" name="grabar" value="si">
                        <input type="number" name="id_reg" class="form-control" value="<?php echo $_GET['id_reg'];?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Valor del servicio:</label>
                        <input type="text" name="val_servicio" class="form-control"
                            value="<?php echo $reg_serv[0]['val_servicio']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Medio de pago:</label>
                        <input type="text" name="medio_pago" class="form-control"
                            value="<?php echo $reg_serv[0]['medio_pago']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Fecha:</label>
                        <input type="text" name="fecha" class="form-control"
                            value="<?php echo $reg_serv[0]['fecha']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">Estado:</label>
                        <input type="text" name="estado" class="form-control"
                            value="<?php echo $reg_serv[0]['estado']; ?>"><br>
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