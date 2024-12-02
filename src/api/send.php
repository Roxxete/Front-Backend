<?php
/**
 * @file enviarCorreo.php
 * @brief Maneja el registro de usuarios y el envío de un correo electrónico para verificar la cuenta.
 *
 * Este script procesa una solicitud POST para registrar un nuevo usuario. Si el email proporcionado 
 * no está registrado, se envía un correo con un enlace de verificación que incluye un código único 
 * y parámetros adicionales.
 *
 * @details
 * - Verifica que el email no esté previamente registrado en la base de datos.
 * - Configura y envía un correo utilizando la librería PHPMailer.
 * - Responde en formato JSON indicando el resultado de la operación.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note Este script depende de:
 * - `PHPMailer` para enviar correos electrónicos.
 * - `db.php` para la conexión a la base de datos.
 *
 * @par Parámetros de entrada (POST):
 * @param email string Correo electrónico del usuario a registrar.
 * @param codigo string Código de verificación para la cuenta.
 * @param numeroCodificado string Código codificado para validación adicional.
 * @param contrasena string Contraseña del usuario.
 * @param apellidos string Apellidos del usuario.
 * @param nombre string Nombre del usuario.
 * @param emailc string Correo alternativo del usuario.
 * @param usuario string Nombre de usuario único.
 *
 * @par Respuesta JSON:
 * @retval message string Mensaje indicando el resultado de la operación.
 * @retval error bool Indica si hubo un error (true) o si la operación fue exitosa (false).
 *
 * @par Ejemplo de entrada:
 * ```json
 * {
 *   "email": "usuario@example.com",
 *   "codigo": "123456",
 *   "numeroCodificado": "abcdef123456",
 *   "contrasena": "password123",
 *   "apellidos": "Perez",
 *   "nombre": "Juan",
 *   "emailc": "usuario@gmail.com",
 *   "usuario": "juanperez"
 * }
 * ```
 *
 * @par Ejemplo de salida (correo enviado con éxito):
 * ```json
 * {
 *   "message": "Correo enviado correctamente",
 *   "error": false
 * }
 * ```
 *
 * @par Ejemplo de salida (email ya registrado):
 * ```json
 * {
 *   "message": "El correo ya tiene una cuenta creada",
 *   "error": true
 * }
 * ```
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga las dependencias de PHPMailer.
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Verifica que la solicitud sea POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Incluye el archivo de conexión a la base de datos.
    require_once("db.php");

    // Inicializa la respuesta predeterminada.
    $response = array('message' => '', 'error' => true);

    // Obtiene y asigna los datos del formulario.
    $email = $_POST['email']; // Email del usuario.
    $codigo = $_POST['codigo']; // Código de verificación.
    $numeroCodificado = $_POST['numeroCodificado']; // Código adicional codificado.
    $contrasena = $_POST['contrasena']; // Contraseña del usuario.
    $apellidos = $_POST['apellidos']; // Apellidos del usuario.
    $nombre = $_POST['nombre']; // Nombre del usuario.
    $emailc = $_POST['emailc']; // Email alternativo del usuario.
    $usuario = $_POST['usuario']; // Nombre de usuario.

    // Consulta la base de datos para verificar si el email ya está registrado.
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $mysql->query($query);

    if ($result->num_rows > 0) {
        // El correo ya está registrado, responde con un mensaje de error.
        $response['message'] = "El correo ya tiene una cuenta creada";
    } else {
        // Configura y envía el correo utilizando PHPMailer.
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP.
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP.
            $mail->SMTPAuth = true;
            $mail->Username = 'o3sense.gti@gmail.com'; // Correo del remitente.
            $mail->Password = 'cwyc auky iadt fxzw'; // Contraseña del remitente.
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Encriptación SSL/TLS.
            $mail->Port = 465; // Puerto seguro.

            // Configuración del correo.
            $mail->setFrom('o3sense.gti@gmail.com', 'O3SENSE'); // Remitente.
            $mail->addAddress($email); // Destinatario.
            $mail->isHTML(true);
            $mail->Subject = "Verificar correo"; // Asunto del correo.

            // Cuerpo del correo.
            $mail_template = "
                <h2>¡O3Sense te da la bienvenida!</h2>
                <p>Usa el siguiente código para verificar tu cuenta y verificar la calidad del aire en un click:</p>
                <h1>$codigo</h1>
                <a href='http://localhost/prueba/src/html/verificarcodigo.html?codigo=$numeroCodificado&nombre=$nombre&apellidos=$apellidos&contrasena=$contrasena&email=$emailc&usuario=$usuario'>
                    Verificar mi correo
                </a>";
            $mail->Body = $mail_template;

            // Intenta enviar el correo.
            if ($mail->send()) {
                $response['message'] = 'Correo enviado correctamente';
                $response['error'] = false;
            } else {
                $response['message'] = 'Error al enviar el correo';
            }
        } catch (Exception $e) {
            // Captura y maneja cualquier error de PHPMailer.
            $response['message'] = 'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
    }

    // Devuelve la respuesta en formato JSON.
    echo json_encode($response);
}
?>
