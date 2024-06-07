<?php
session_start();
$_SESSION['timeout'] = time();
include('../crud/Conexion.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Conductor - Página Principal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sw/dist/sweetalert2.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aventureros SA</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../login/cerrar.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    $cond = new Conductores();
    $reg = $cond->vercond();
    ?>
    <div class="container mt-4">
        <h1>¡Bienvenid@</h1>
        <h2>Total de Servicios Realizados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Número de Registro</th>
                    <th>Identificación</th>
                    <th>Nombre del Conductor</th>
                    <th>Servicio</th>
                    <th>Categoría</th>
                    <th>Valor del Servicio</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg); $i++) {
                    echo "<tr>
        <td>" . $reg[$i]['nroregistro'] . "</td>
        <td>" . $reg[$i]['identificacion'] . "</td>
        <td>" . $reg[$i]['nombre_conductor'] . "</td>
        <td>" . $reg[$i]['servicio'] . "</td>
        <td>" . $reg[$i]['categoria'] . "</td>
        <td>" . $reg[$i]['valor_servicio'] . "</td>
        <td>" . $reg[$i]['origen'] . "</td>
        <td>" . $reg[$i]['destino'] . "</td>
        <td>" . $reg[$i]['fecha'] . "</td>  
        <td>" . $reg[$i]['estado'] . "</td>    
        ";
                }
                ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Registrar vehiculo</h3>
                        <a href="../crud/registro_vehi.php" class="btn btn-primary">Registrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h2>ULTIMO SERVICIO REALIZADO/EN CURSO</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Número de Registro</th>
                    <th>Identificación</th>
                    <th>Nombre del Conductor</th>
                    <th>Servicio</th>
                    <th>Categoría</th>
                    <th>Valor del Servicio</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg); $i++) {
                    echo "<tr>
        <td>" . $reg[$i]['nroregistro'] . "</td>
        <td>" . $reg[$i]['identificacion'] . "</td>
        <td>" . $reg[$i]['nombre_conductor'] . "</td>
        <td>" . $reg[$i]['servicio'] . "</td>
        <td>" . $reg[$i]['categoria'] . "</td>
        <td>" . $reg[$i]['valor_servicio'] . "</td>
        <td>" . $reg[$i]['origen'] . "</td>
        <td>" . $reg[$i]['destino'] . "</td>
        <td>" . $reg[$i]['fecha'] . "</td>  
        <td>" . $reg[$i]['estado'] . "</td>        
        ";
                }
                ?>
            </tbody>
        </table>
        <form method="post" action="../crud/terminar_servicio.php">
    <input type="hidden" name="id_servicio" value="<?php echo $id_servicio; ?>">

    <h3>Terminar servicio</h3>
    <button type="submit" class="btn btn-primary" name="terminar_servicio">Terminar</button>
</form>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../sw/dist/sweetalert2.min.js"></script>

</body>

</html>