<?php
session_start();
include('Conexion.php');

if (isset($_SESSION['id_cond'])) {

    $id_servicio = obtenerUltimoServicioDelConductor($_SESSION['id_cond']);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["terminar_servicio"])) {
        if (isset($id_servicio)) {
            $actualizado = actualizarEstadoServicio($id_servicio);

            if ($actualizado) {
                header('Location: ../conductores/conductor.php');
                exit;
            } else {
                echo "Error al actualizar el estado del servicio.";
            }
        } else {
            echo "Error: ID del servicio no definido.";
        }
    }
} else {
    echo "No se ha iniciado sesión como conductor.";
}

function obtenerUltimoServicioDelConductor($id_conductor) {
    $pg = Conectar::conec();
    
    $query = "SELECT id_reg FROM reg_servicio WHERE id_cond = $1 ORDER BY id_reg DESC LIMIT 1";
    $result = pg_query_params($pg, $query, array($id_conductor));

    if ($result) {
        $row = pg_fetch_assoc($result);
        return $row['id_reg'];
    } else {
        return null;
    }
}
function actualizarEstadoServicio($id_servicio) {
    $pg = Conectar::conec();
    $query = "UPDATE reg_servicio SET estado = 'Terminado' WHERE id_reg = $1";
    $result = pg_query_params($pg, $query, array($id_servicio));

    return $result; 
}
