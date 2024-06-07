<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../sw/dist/sweetalert2.min.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aventureros SA</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../clientes/cliente.php">Volver</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Pedir Servicio</h1>
                <form method="post" action="../crud/insert_serv.php">
                    <div class="mb-3">
                        <label for="servicio" class="form-label">Tipo de servicio:</label>
                        <select name="id_serv" id="id_serv" class="form-select" required>
                            <option value="1">Pasajeros</option>
                            <option value="2">Alimentos</option>
                            <option value="3">Todos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <select name="id_cat" id="id_cat" class="form-select" required>
                            <option value="1">Normal</option>
                            <option value="2">Especial</option>
                            <option value="3">Urgente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Medio de pago:</label>
                        <select name="medio_pago" id="medio_pago" class="form-select" required>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Pedir Servicio</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../sw/dist/sweetalert2.min.js"></script>

</body>

</html>