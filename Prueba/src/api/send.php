<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("db.php");

    $response = array('message' => '', 'error' => true);

    // Escapar datos de entrada para evitar inyecciones SQL
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    $numeroCodificado = $_POST['numeroCodificado'];
    $contrasena = $_POST['contrasena'];
    $apellidos = $_POST['apellidos'];
    $nombre = $_POST['nombre'];
    $emailc = $_POST['emailc'];
    $usuario = $_POST['usuario'];

    // Verificación de existencia de correo
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $mysql->query($query);

    if ($result->num_rows > 0) {
        $response['message'] = "El correo ya tiene una cuenta creada";
    } else {
        // Configuración y envío de correo
        $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'o3sense.gti@gmail.com';
            $mail->Password = 'cwyc auky iadt fxzw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('o3sense.gti@gmail.com', 'O3SENSE');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Verificar correo";

            // Cuerpo del correo
            $mail_template = "
<<<<<<< HEAD
                <h2>¡O3Sense te da la bienvenida!</h2>
                <p>Usa el siguiente código para verificar tu cuenta y verificar la calidad del aire en un click:</p>
=======
                <h2>¡Bienvenido!</h2>
                <p>Por favor, usa el siguiente código para verificar tu cuenta:</p>
>>>>>>> origin/Alex
                <h1>$codigo</h1>
                <a href='http://localhost/prueba/src/html/verificarcodigo.html?codigo=$numeroCodificado&nombre=$nombre&apellidos=$apellidos&contrasena=$contrasena&email=$emailc&usuario=$usuario'>
                    Verificar mi correo
                </a>";
            $mail->Body = $mail_template;

            if ($mail->send()) {
                $response['message'] = 'Correo enviado correctamente';
                $response['error'] = false;
            } else {
                $response['message'] = 'Error al enviar el correo';
            }
    }

    echo json_encode($response);
}
?>
