<?php
include('Conexion.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

$pg = Conectar::conec();
$email = $_POST['correo'];

$sql = "SELECT * FROM usuario WHERE correo='$email'";
$result = pg_query($pg, $sql);

if ($result) {
    $row = pg_fetch_assoc($result);

    if ($row) {
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                    // Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                           // Enable SMTP authentication
            $mail->Username   = 'johanesv15@hotmail.com';      // SMTP username
            $mail->Password   = 'Johanes1032';                 // SMTP password
            $mail->Port       = 587;                            // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('johanesv15@hotmail.com', 'Johan');
            $mail->addAddress($email); 


            // Content
            $mail->isHTML(true);                               // Set email format to HTML 
            $mail->Subject = 'Recuperacion de contrasena';
            $mail->Body = 'Hola, este es un correo generado para recuperar tu clave, por favor visita la siguiente pagina: <a href="http://localhost:8080/nueva_pass.php?usuario='.$row['usuario'].'">Cambiar Clave</a>
            ';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Correo enviado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='../index.php';
                }
            });
            </script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "Error al realizar la consulta: " . pg_last_error($pg);
}
?>
