<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../sw/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
<?php
class Conectar{
    public static function conec(){
        $host = "postgres"; 
        $user = "postgres";  
        $pass = "Johanes1032"; 
        $db_name = "proyfinal"; 

        $pg = pg_connect("host=$host dbname=$db_name user=$user password=$pass")
        or die("ERROR al conectar la BD: " . pg_last_error());
        return $pg;
    }
}

class Usuarios{
    private $usu;
    public function __construct(){
        $this->usu = array();
    }
    public function verusu(){
        $pg = Conectar::conec();
        $usuario = $_SESSION['usuario'];
        $sql = "SELECT * FROM usuario";
        $result = pg_query($pg, $sql);

        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $clie = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $usu[] = $row;
        }
    
        pg_close($pg);
    
        return $usu;
    }
    public function elimusu($usuario){
    $pg = Conectar::conec();
    $sql = "DELETE FROM usuario WHERE usuario = '$usuario'";

    $result = pg_query($pg, $sql);

    echo "
    <script type='text/javascript'>
    Swal.fire({
       icon : 'success',
       title : 'Operacion Exitosa!!',
       text :  'Eliminado Correctamente'
    }).then((result) => {
        if(result.isConfirmed){
            window.location='../admin/admin.php';
        }
    });
    </script>";

    pg_close($pg);
    }

    public function get_usu($usuario){
        $sql="select * from usuario where usuario='$usuario'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->usu[]=$row;
        }
        return $this->usu;
    }

    public function editarusu($usuario, $pass, $tipo, $correo, $usuarioAnterior) {
        $pg = Conectar::conec();
        
        // Escapa los valores para evitar inyección SQL
        $usuario = pg_escape_string($pg, $usuario);
        $pass = pg_escape_string($pg, $pass);
        $tipo = pg_escape_string($pg, $tipo);
        $correo = pg_escape_string($pg, $correo);
        $usuarioAnterior = pg_escape_string($pg, $usuarioAnterior);
    
        // Actualiza el usuario que coincide con el nombre de usuario anterior
        $sql = "UPDATE usuario SET usuario='$usuario', pass='$pass', tipo='$tipo', correo='$correo' WHERE usuario='$usuarioAnterior'";
        $result = pg_query($pg, $sql);
    
        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Usuario editado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "Error al editar el usuario: " . pg_last_error($pg);
        }
    }
    
}
class Clientes {
    private $clie;
    public function __construct(){
        $this->clie = array();
    }
    public function verclie(){
        $pg = Conectar::conec();
        $usuario = $_SESSION['usuario'];

            $sql = "SELECT * FROM servs_cliente_vw WHERE usuario='$usuario'";
            $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $clie = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $clie[] = $row;
        }
    
        pg_close($pg);
    
        return $clie;
    }
    public function cliente(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM cliente";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $cliente = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $cliente[] = $row;
        }
    
        pg_close($pg);
    
        return $cliente;
    }
    public function insertclie($id_cliente, $nombre, $apellido, $direccion, $genero, $nacionalidad, $usuario) {
        $pg = Conectar::conec();

        $id_cliente = pg_escape_string($id_cliente);
        $nombre = pg_escape_string($nombre);
        $apellido = pg_escape_string($apellido);
        $direccion = pg_escape_string($direccion);
        $genero = pg_escape_string($genero);
        $nacionalidad = pg_escape_string($nacionalidad);
        $usuario = pg_escape_string($usuario);

        $query = "INSERT INTO cliente (id_cliente, nombre, apellido, direccion, genero, nacionalidad, usuario) VALUES ('$id_cliente', '$nombre', '$apellido', '$direccion', '$genero', '$nacionalidad', '$usuario')";

        $result = pg_query($pg, $query);

        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Cliente insertado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../index.php';
            }
        });
        </script>";
    }
    public function inserttelc($id_cliente, $telefono) {
        $pg = Conectar::conec();

        $id_cliente = pg_escape_string($id_cliente);
        $telefono = pg_escape_string($telefono);

        $query = "INSERT INTO tel_cliente (id_cliente, telefono) VALUES ('$id_cliente', '$telefono')";

        $result = pg_query($pg, $query);

    }
    public function get_idc($id_cliente){
        $sql="select * from cliente where id_cliente=$id_cliente";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->clie[]=$row;
        }
        return $this->clie;
    }
 
    
    
public function elimc($id_cliente) {
    $pg = Conectar::conec();
    $sql = "DELETE FROM cliente WHERE id_cliente = $id_cliente";

    $result = pg_query($pg, $sql);

    echo "
    <script type='text/javascript'>
    Swal.fire({
       icon : 'success',
       title : 'Operacion Exitosa!!',
       text :  'Eliminado Correctamente'
    }).then((result) => {
        if(result.isConfirmed){
            window.location='../admin/admin.php';
        }
    });
    </script>";

    pg_close($pg);
}

public function editarclie($id_cliente, $nombre, $apellido, $direccion, $genero, $nacionalidad, $usuario) {
    $pg = Conectar::conec();
    
    $sql = "UPDATE cliente SET nombre='$nombre', apellido='$apellido', direccion='$direccion', genero='$genero', nacionalidad='$nacionalidad', usuario='$usuario' WHERE id_cliente = $id_cliente";

    $result = pg_query($pg, $sql);


    echo "
    <script type='text/javascript'>
    Swal.fire({
       icon : 'success',
       title : 'Operacion Exitosa!!',
       text :  'Cliente editado Correctamente'
    }).then((result) => {
        if(result.isConfirmed){
            window.location='../admin/admin.php';
        }
    });
    </script>";
}

}

Class Conductores{
    private $cond;
    public function __construct(){
        $this->cond = array();
    }
    public function insertcond($id_cond, $nombre, $apellido, $direccion, $genero, $nacionalidad, $usuario) {
        $pg = Conectar::conec(); 

        $id_cond = pg_escape_string($id_cond);
        $nombre = pg_escape_string($nombre);
        $apellido = pg_escape_string($apellido);
        $direccion = pg_escape_string($direccion);
        $genero = pg_escape_string($genero);
        $nacionalidad = pg_escape_string($nacionalidad);
        $usuario = pg_escape_string($usuario);

        $query = "INSERT INTO conductor (id_cond, nombre, apellido, direccion, genero, nacionalidad, usuario) VALUES ('$id_cond', '$nombre', '$apellido', '$direccion', '$genero', '$nacionalidad', '$usuario')";

        $result = pg_query($pg, $query);
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Conductor insertado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../index.php';
            }
        });
        </script>";
    }
    public function inserttelcond($id_cond, $telefono) {
        $pg = Conectar::conec();

        $id_cond = pg_escape_string($id_cond);
        $telefono = pg_escape_string($telefono);

        $query = "INSERT INTO tel_conductor (id_cond, telefono) VALUES ('$id_cond', '$telefono')";

        $result = pg_query($pg, $query);

    }

    public function vercond(){
        $pg = Conectar::conec();
        $id = $_SESSION['usuario'];
        $sql = "SELECT * FROM servs_cond_vw WHERE usuario='$id'";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $cond = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $cond[] = $row;
        }
    
        pg_close($pg);
    
        return $cond;
    }
    public function conductor(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM conductor";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $conductores = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $conductores[] = $row;
        }
    
        pg_close($pg);
    
        return $conductores;
    }
    public function get_idcond($id_cond){
        $sql="select * from conductor where id_cond=$id_cond";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->cond[]=$row;
        }
        return $this->cond;
    }
    public function elimcond($id_cond) {
        $pg = Conectar::conec();
    
        $sql = "DELETE FROM conductor WHERE id_cond = $id_cond";
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Eliminado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    
        pg_close($pg);
    }
    public function editarcond($id_cond, $nombre, $apellido, $direccion, $genero, $nacionalidad, $usuario) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE conductor SET nombre='$nombre', apellido='$apellido', direccion='$direccion', genero='$genero', nacionalidad='$nacionalidad', usuario='$usuario' WHERE id_cond = $id_cond";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
    
}
class Vehiculos {
    private $vehi;
    public function __construct() {
        $this->vehi = array();
    }
    public function vehiculo(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM vehiculo";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $vehiculos = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $vehiculos[] = $row;
        }
    
        pg_close($pg);
    
        return $vehiculos;
    }
    public function insertarve($placa, $modelo, $id_serv, $id_cond) {
        $pg = Conectar::conec();

        $placa = pg_escape_string($pg, $placa);
        $modelo = pg_escape_string($pg, $modelo);
        $id_serv = pg_escape_string($pg, $id_serv);
        $id_cond = pg_escape_string($pg, $id_cond);

        $query = "INSERT INTO vehiculo (placa, modelo, id_serv, id_cond) VALUES ('$placa', '$modelo', '$id_serv', '$id_cond')";

        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Vehículo insertado Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../conductores/conductor.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar el vehículo. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function get_placa($placa){
        $sql="select * from vehiculo where placa='$placa'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->vehi[]=$row;
        }
        return $this->vehi;
    }
    public function editarvehi($placa, $modelo) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE vehiculo SET placa='$placa', modelo='$modelo' WHERE placa = $placa";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
}
class Categorias {
    private $cate;
    public function __construct() {
        $this->cate = array();
    }
    public function categoria(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM categoria";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $categorias = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $categorias[] = $row;
        }
    
        pg_close($pg);
    
        return $categorias;
    }
    public function insertarcat($id_cat, $nombre, $tarifa) {
        $pg = Conectar::conec();

        $id_cat = pg_escape_string($pg, $id_cat);
        $nombre = pg_escape_string($pg, $nombre);
        $tarifa = pg_escape_string($pg, $tarifa);

        $query = "INSERT INTO categoria (id_cat, nombre, tarifa) VALUES ('$id_cat', '$nombre', '$tarifa')";

        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Categoria insertada Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar la categoria. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function get_id_cat($id_cat){
        $sql="select * from categoria where id_cat='$id_cat'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->cate[]=$row;
        }
        return $this->cate;
    }
    public function editarcate($id_cat, $nombre, $tarifa) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE categoria SET id_cat='$id_cat', nombre='$nombre', tarifa='$tarifa' WHERE id_cat = $id_cat";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
}
class Servicios {
    private $serv;
    public function __construct() {
        $this->serv = array();
    }
    public function servicio(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM servicio";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $servicios = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $servicios[] = $row;
        }
    
        pg_close($pg);
    
        return $servicios;
    }
    public function insertarserv($id_serv, $nombre, $tarifa) {
        $pg = Conectar::conec();

        $id_serv = pg_escape_string($pg, $id_serv);
        $nombre = pg_escape_string($pg, $nombre);
        $id_serv = pg_escape_string($pg, $tarifa);

        $query = "INSERT INTO servicio(id_serv, nombre, tarifa) VALUES ('$id_serv', '$nombre', '$tarifa')";

        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Servicio insertado Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar el servicio. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function get_id_serv($id_serv){
        $sql="select * from servicio where id_serv='$id_serv'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->serv[]=$row;
        }
        return $this->serv;
    }
    public function editarserv($id_serv, $nombre, $tarifa) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE servicio SET id_serv='$id_serv', nombre='$nombre', tarifa='$tarifa' WHERE id_serv = $id_serv";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
}
class Rutas {
    private $ruta;
    public function __construct() {
        $this->ruta = array();
    }
    public function ruta(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM ruta";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $rutas = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $rutas[] = $row;
        }
    
        pg_close($pg);
    
        return $rutas;
    }
    public function insertarruta($id_ruta, $dir_origen, $dir_destino) {
        $pg = Conectar::conec();

        $id_ruta = pg_escape_string($pg, $id_ruta);
        $dir_origen = pg_escape_string($pg, $dir_origen);
        $dir_destino = pg_escape_string($pg, $dir_destino);

        $query = "INSERT INTO ruta (id_ruta, dir_origen, dir_destino) VALUES ('$id_ruta', '$dir_origen', '$dir_destino')";

        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Ruta insertada Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar la ruta. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function get_id_ruta($id_ruta){
        $sql="select * from ruta where id_ruta='$id_ruta'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->ruta[]=$row;
        }
        return $this->ruta;
    }
    public function editarruta($id_ruta, $dir_origen, $dir_destino) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE ruta SET id_ruta='$id_ruta', dir_origen='$dir_origen' WHERE id_ruta = $id_ruta";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
}
class Telefonos {
    private $tel;
    public function __construct() {
        $this->tel = array();
    }
    public function telclie(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM tel_cliente";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $tel = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $tel[] = $row;
        }
    
        pg_close($pg);
    
        return $tel;
    }
    public function telcond(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM tel_conductor";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $tel = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $tel[] = $row;
        }
    
        pg_close($pg);
    
        return $tel;
    }
    public function insertartelclie($telefono) {
        $pg = Conectar::conec();

        $placa = pg_escape_string($pg, $telefono);

        $query = "INSERT INTO tel_cliente (telefono) VALUES ('$telefono')";

        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Telefono insertado Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar la ruta. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function insertartelcond($telefono) {
        $pg = Conectar::conec();

        $placa = pg_escape_string($pg, $telefono);

        $query = "INSERT INTO tel_conductor (telefono) VALUES ('$telefono')";

        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Telefono insertado Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar la ruta. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function get_id_telclie($id_cliente){
        $sql="select * from tel_cliente where id_cliente='$id_cliente'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->tel[]=$row;
        }
        return $this->tel;
    }
    public function get_id_telcond($id_conductor){
        $sql="select * from tel_conductor where id_conductor='$id_conductor'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->tel[]=$row;
        }
        return $this->tel;
    }
    public function editartelclie($id_cliente, $telefono) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE tel_cliente SET id_cliente='$id_cliente', telefono='$telefono' WHERE id_cliente = $id_cliente";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
    public function editartelcond($id_conductor, $telefono) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE tel_conductor SET id_conductor='$id_conductor', telefono='$telefono' WHERE id_conductor = $id_conductor";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
}
class Registros {
    private $reg;
    public function __construct() {
        $this->reg = array();
    }
    public function reg(){
        $pg = Conectar::conec();
    
        $sql = "SELECT * FROM reg_servicio";
    
        $result = pg_query($pg, $sql);
    
        if (!$result) {
            die("Error en la consulta: " . pg_last_error($pg));
        }
    
        $rutas = array();
    
        while ($row = pg_fetch_assoc($result)) {
            $reg[] = $row;
        }
    
        pg_close($pg);
    
        return $reg;
    }
    public function insertarreg($id_reg, $id_cond, $id_cliente, $id_serv, $val_servicio, $medio_pago, $fecha, $id_cat, $id_ruta, $estado ) {
        $pg = Conectar::conec();

        $id_reg = pg_escape_string($pg, $id_reg);
        $id_cond = pg_escape_string($pg, $id_cond);
        $id_cliente = pg_escape_string($pg, $id_cliente);
        $id_serv = pg_escape_string($pg, $id_serv);
        $val_servicio = pg_escape_string($pg, $val_servicio);
        $medio_pago = pg_escape_string($pg, $medio_pago);
        $fecha = pg_escape_string($pg, $fecha);
        $id_cat = pg_escape_string($pg, $id_cat);
        $id_ruta = pg_escape_string($pg, $id_ruta);
        $estado = pg_escape_string($pg, $estado);

        $query = "INSERT INTO reg_servicio (id_ruta, id_cond, id_cliente, id_serv, val_servicio, medio_pago, fecha, id_cat, id_ruta, estado) VALUES ('$id_ruta', '$id_cond', '$id_cliente', '$id_serv', '$val_servicio', '$medio_pago', '$fecha', '$id_cat', '$id_ruta', '$estado')";
        $result = pg_query($pg, $query);

        if ($result) {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operación Exitosa!!',
               text :  'Registro insertado Correctamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='../admin/admin.php';
                }
            });
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'error',
               title : 'Error',
               text :  'No se pudo insertar la ruta. Por favor, inténtalo de nuevo.'
            });
            </script>";
        }
    }
    public function get_id_reg($id_reg){
        $sql="select * from reg_servicio where id_reg='$id_reg'";
        $res=pg_query(Conectar::conec(),$sql);
        if($row=pg_fetch_assoc($res)){
            $this->reg[]=$row;
        }
        return $this->reg;
    }
    public function editarreg($id_reg, $val_servicio, $medio_pago, $fecha, $estado) {
        $pg = Conectar::conec();
        
        
        $sql = "UPDATE reg_servicio SET id_reg='$id_reg', val_servicio='$val_servicio', medio_pago='$medio_pago', fecha='$fecha', estado='$estado' WHERE id_reg = $id_reg";
        
        $result = pg_query($pg, $sql);
    
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'Editado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='../admin/admin.php';
            }
        });
        </script>";
    }
}
?>

<script src="../sw/dist/sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>