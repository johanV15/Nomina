<?php
session_start();
include('../crud/Conexion.php');
if($_SESSION['usuario']){
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin - Página Principal</title>
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
    $clientes = new Clientes();
    $reg = $clientes->cliente();
    $conductores = new Conductores();
    $reg2 = $conductores->conductor();
    $usuarios = new Usuarios();
    $reg3 = $usuarios->verusu();
    $vehiculos = new Vehiculos();
    $reg4 = $vehiculos->vehiculo();
    $categorias = new Categorias();
    $reg5 = $categorias->categoria();
    $servicios = new Servicios();
    $reg6 = $servicios->servicio();
    $rutas = new Rutas();
    $reg7 = $rutas->ruta();
    $tel = new Telefonos();
    $reg8 = $tel->telclie();
    $reg9 = $tel->telcond();
    $reg_serv = new Registros();
    $reg10 = $reg_serv->reg();
    ?>
    <div class="container mt-6">
        <h1>¡Bienvenid@, Administrador!</h1>

        <h2>Clientes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Género</th>
                    <th>Nacionalidad</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg); $i++) {
                    echo "<tr>
        <td>" . $reg[$i]['id_cliente'] . "</td>
        <td>" . $reg[$i]['nombre'] . "</td>
        <td>" . $reg[$i]['apellido'] . "</td>
        <td>" . $reg[$i]['direccion'] . "</td>
        <td>" . $reg[$i]['genero'] . "</td>
        <td>" . $reg[$i]['nacionalidad'] . "</td>
        <td>" . $reg[$i]['usuario'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick=window.location="../crud/editar_clientes.php?id=<?php echo $reg[$i]['id_cliente']; ?>">
                            <span class="material-symbols-outlined">Editar</span>
                            <button class="btn btn-danger"
                                onclick=window.location="../crud/eliminar.php?id=<?php echo $reg[$i]['id_cliente']; ?>">
                                <span class="material-symbols-outlined">Eliminar</span>
                                <?php
                }
                ?>
            </tbody>
        </table>

        <h2>Conductores</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Género</th>
                    <th>Nacionalidad</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg2); $i++) {
                    echo "<tr>
        <td>" . $reg2[$i]['id_cond'] . "</td>
        <td>" . $reg2[$i]['nombre'] . "</td>
        <td>" . $reg2[$i]['apellido'] . "</td>
        <td>" . $reg2[$i]['direccion'] . "</td>
        <td>" . $reg2[$i]['genero'] . "</td>
        <td>" . $reg2[$i]['nacionalidad'] . "</td>
        <td>" . $reg2[$i]['usuario'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick=window.location="../crud/editar_conductores.php?id=<?php echo $reg2[$i]['id_cond']; ?>">
                            <span class="material-symbols-outlined">Editar</span>
                            <button class="btn btn-danger"
                                onclick=window.location="../crud/eliminar.php?id=<?php echo $reg2[$i]['id_cond']; ?>">
                                <span class="material-symbols-outlined">Eliminar</span>
                                <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Usuarios</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>usuario</th>
                    <th>Contraseña</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg3); $i++) {
                    echo "<tr>
        <td>" . $reg3[$i]['usuario'] . "</td>
        <td>" . $reg3[$i]['pass'] . "</td>
        <td>" . $reg3[$i]['tipo'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_usua.php?usuario=<?php echo $reg3[$i]['usuario']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_usu.php?usuario=<?php echo $reg3[$i]['usuario']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Vehiculos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Modelo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg4); $i++) {
                    echo "<tr>
        <td>" . $reg4[$i]['placa'] . "</td>
        <td>" . $reg4[$i]['modelo'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_vehiculos.php?placa=<?php echo $reg4[$i]['placa']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_vehiculos.php?placa=<?php echo $reg4[$i]['placa']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Categorias</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>TARIFA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg5); $i++) {
                    echo "<tr>
        <td>" . $reg5[$i]['id_cat'] . "</td>
        <td>" . $reg5[$i]['nombre'] . "</td>
        <td>" . $reg5[$i]['tarifa'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_cate.php?id_cat=<?php echo $reg5[$i]['id_cat']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_cate.php?id_cat=<?php echo $reg5[$i]['id_cat']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Servicio</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TARIFA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg6); $i++) {
                    echo "<tr>
        <td>" . $reg6[$i]['id_serv'] . "</td>
        <td>" . $reg6[$i]['nombre'] . "</td>
        <td>" . $reg6[$i]['tarifa'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_serv.php?id_serv=<?php echo $reg6[$i]['id_serv']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_serv.php?id_serv=<?php echo $reg6[$i]['id_serv']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Rutas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Direccion de Origen</th>
                    <th>Direccion de Destino</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg7); $i++) {
                    echo "<tr>
        <td>" . $reg7[$i]['id_ruta'] . "</td>
        <td>" . $reg7[$i]['dir_origen'] . "</td>
        <td>" . $reg7[$i]['dir_destino'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_ruta.php?id_ruta=<?php echo $reg7[$i]['id_ruta']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_ruta.php?id_ruta=<?php echo $reg7[$i]['id_ruta']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Telefonos Clientes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg8); $i++) {
                    echo "<tr>
        <td>" . $reg8[$i]['id_cliente'] . "</td>
        <td>" . $reg8[$i]['telefono'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_telclie.php?id_cliente=<?php echo $reg8[$i]['id_cliente']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_telclie.php?id_cliente=<?php echo $reg8[$i]['id_cliente']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Telefonos Conductores</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg9); $i++) {
                    echo "<tr>
        <td>" . $reg9[$i]['id_conductor'] . "</td>
        <td>" . $reg9[$i]['telefono'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_telcond.php?id_conductor=<?php echo $reg9[$i]['id_conductor']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_telcond.php?id_conductor=<?php echo $reg9[$i]['id_conductor']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <h2>Registros servicios</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor del servicio</th>
                    <th>Medio de pago</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($reg10); $i++) {
                    echo "<tr>
        <td>" . $reg10[$i]['id_reg'] . "</td>
        <td>" . $reg10[$i]['val_servicio'] . "</td>
        <td>" . $reg10[$i]['medio_pago'] . "</td>
        <td>" . $reg10[$i]['fecha'] . "</td>
        <td>" . $reg10[$i]['estado'] . "</td>
        ";
                    ?>
                    <td align='center'>
                        <button class="btn btn-warning"
                            onclick="window.location='../crud/editar_reg.php?id_reg=<?php echo $reg10[$i]['id_reg']; ?>';">
                            <span class="material-symbols-outlined">Editar</span>

                            <button class="btn btn-danger"
                                onclick="window.location='../crud/eliminar_reg.php?id_reg=<?php echo $reg10[$i]['id_reg']; ?>';">
                                <span class="material-symbols-outlined">Eliminar</span>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <button type="button" class="btn btn-primary" onclick="window.location.href='../crud/registro.php'">Insertar
            usuarios</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../sw/dist/sweetalert2.min.js"></script>

</body>

</html>
<?php
}else{
    $_SESSION['usuario']=NULL;
    echo "
    <script type='text/javascript'>
     Swal.fire({
     icon : 'error',
    title : 'ERROR!!',
     text :  ' Debe iniciar Session en el Sistema'
    }).then((result) => {
         if(result.isConfirmed){
         window.location='../index.php';
        }
    }); </script>";
}
?>