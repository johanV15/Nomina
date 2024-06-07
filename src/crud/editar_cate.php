<?php
include('Conexion.php');
$cate = new Categorias();
if(isset($_POST['grabar']) && $_POST['grabar'] =='si'){
$cate->editarcate($_REQUEST['id_cat'],$_REQUEST['nombre'],$_REQUEST['tarifa']);
exit();
}
$categoria=$cate->get_id_cat($_GET['id_cat']);
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
        <h1>EDITAR Categorias</h1>
        <div class="card-body">
            <form name="form" action="editar_cate.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="id_cat">ID:</label>
                        <input type="hidden" name="grabar" value="si">
                        <input type="number" name="id_cat" class="form-control" value="<?php echo $_GET['id_cat'];?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">NOMBRE:</label>
                        <input type="text" name="nombre" class="form-control"
                            value="<?php echo $categoria[0]['nombre']; ?>"><br>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre">TARIFA:</label>
                        <input type="number" name="tarifa" class="form-control"
                            value="<?php echo $categoria[0]['tarifa']; ?>"><br>
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