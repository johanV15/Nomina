<!DOCTYPE html>
<html>
<head>
    <title>Recuperacion de Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../sw/dist/sweetalert2.min.css">


</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Recuperacion de contraseña</h1>
                <form method="post" action="crud/nueva_pass.php">
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña:</label>
                        <input type="text" name="new_pass" id="new_pass" class="form-control" required>
                        <input type="hidden" name="usuario" id="usuario" value="<?php echo $_GET['usuario'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Recuperar Contraseña</button><br>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../sw/dist/sweetalert2.min.js"></script>

</body>
</html>
