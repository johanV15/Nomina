<?php
session_start();
include('Conexion.php');


if (isset($_SESSION['id_cliente'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_serv = $_POST['id_serv'];
        $id_cat = $_POST['id_cat'];
        $medio_pago = $_POST['medio_pago'];

        $valor_servicio = obtenerTarifaServicio($id_serv);

        $valor_categoria = obtenerTarifaCategoria($id_cat);

        if ($valor_servicio !== null && $valor_categoria !== null) {
            $valor_total = $valor_servicio + $valor_categoria;

            if (isset($_SESSION['id_cliente'])) {
                $id_cliente = $_SESSION['id_cliente'];

                $id_cond = obtenerConductorDisponible($id_serv);

                $fecha = date("Y-m-d");

                $id_ruta = insertarRuta('CL 90 C SUR 1-45', 'Dirección Destino'); 
                $dir_destino = obtenerDireccionCliente($id_cliente); 


                if ($id_ruta) {
                    $id_reg = insertarServicio($id_cond, $id_cliente, $id_serv, $valor_total, $medio_pago, $fecha, $id_cat, $id_ruta);

                    if ($id_reg) {
                        echo "
                        <script type='text/javascript'>
                        Swal.fire({
                           icon : 'success',
                           title : 'Operacion Exitosa!!',
                           text :  'Servicio Pedido correctamente'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location='../clientes/cliente.php';
                            }
                        });
                        </script>";
                    } else {
                        echo "Error al registrar el servicio.";
                    }
                } else {
                    echo "Error al registrar la ruta.";
                }
            } else {
                echo "Error: No se ha definido un cliente.";
            }
        } else {
            echo "Error al obtener las tarifas de servicio o categoría.";
        }
    }
} else {
    echo "Error: No se ha definido un cliente.";
}



function calcularValorTotal($id_serv, $id_cat) {
    $pg = Conectar::conec();

    $queryServicio = "SELECT tarifa FROM servicio WHERE id_serv = $1";
    $resultServicio = pg_query_params($pg, $queryServicio, array($id_serv));
    $tarifaServicio = pg_fetch_assoc($resultServicio);

    $queryCategoria = "SELECT tarifa FROM categoria WHERE id_cat = $1";
    $resultCategoria = pg_query_params($pg, $queryCategoria, array($id_cat));
    $tarifaCategoria = pg_fetch_assoc($resultCategoria);

    if ($tarifaServicio !== null && $tarifaCategoria !== null) {
        return $tarifaServicio['tarifa'] + $tarifaCategoria['tarifa'];
    } else {
        return null;
    }
}

function obtenerConductorDisponible($id_serv) {
    $pg = Conectar::conec();
    $query = "SELECT cond_disponible($id_serv) as id_cond";
    $result = pg_query($pg, $query);
    $row = pg_fetch_assoc($result);
    return $row['id_cond'];
}

function obtenerTarifaServicio($id_serv) {
    $pg = Conectar::conec();
    $query = "SELECT tarifa FROM servicio WHERE id_serv = $id_serv";
    $result = pg_query($pg, $query);
    
    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['tarifa'];
    } else {
        return null;
    }
}

function obtenerTarifaCategoria($id_cat) {
    $pg = Conectar::conec();
    $query = "SELECT tarifa FROM categoria WHERE id_cat = $id_cat";
    $result = pg_query($pg, $query);
    
    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['tarifa'];
    } else {
        return null;
    }
}

function insertarServicio($id_cond, $id_cliente, $id_serv, $valor_servicio, $medio_pago, $fecha, $id_cat, $id_ruta) {
    $pg = Conectar::conec();
    
    $estado = "En camino";
    
    $query = "INSERT INTO reg_servicio (id_cond, id_cliente, id_serv, val_servicio, medio_pago, fecha, id_cat, id_ruta, estado) VALUES ($id_cond, $id_cliente, $id_serv, $valor_servicio, '$medio_pago', '$fecha', $id_cat, $id_ruta, '$estado') RETURNING id_reg";
    $result = pg_query($pg, $query);

    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['id_reg'];
    } else {
        echo "Error al registrar el servicio.";
        return null;
    }
}


function insertarRuta($dir_origen, $dir_destino) {
    $pg = Conectar::conec();
    $query = "INSERT INTO ruta (dir_origen, dir_destino) VALUES ('$dir_origen', '$dir_destino') RETURNING id_ruta";
    $result = pg_query($pg, $query);

    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['id_ruta'];
    } else {
        echo "Error al registrar la ruta.";
        return null;
    }
}
function obtenerDireccionCliente($id_cliente) {
    $pg = Conectar::conec();
    $query = "SELECT direccion FROM cliente WHERE id_cliente = $1";
    $result = pg_query_params($pg, $query, array($id_cliente));

    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['direccion'];
    } else {
        return null;
    }
}


?>
