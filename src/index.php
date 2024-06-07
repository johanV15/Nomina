<!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../sw/dist/sweetalert2.min.css">


</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Ingreso de Usuarios</h1>
                <form method="post" action="login/verifica.php">
                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label">Seleccione el tipo de usuario:</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="admin">Administrador</option>
                            <option value="cliente">Cliente</option>
                            <option value="conductor">Conductor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nombre de Usuario:</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <input type="password" name="pass" id="pass" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button><br>
                    <a href="recovery.php">¿Olvidaste tu contraseña?</a>
                </form>
            </div>
            <div class="col-md-6">
                <p>¿No tienes una cuenta? <a href="crud/registro.php">Crea una aquí</a></p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../sw/dist/sweetalert2.min.js"></script>

</body>
</html>
