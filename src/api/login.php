<?php
/**
 * @file login.php
 * @brief Maneja la autenticación de usuarios mediante una solicitud POST.
 *
 * Este script valida las credenciales del usuario (email y contraseña) enviadas 
 * mediante una solicitud POST. Si las credenciales son correctas, inicia una 
 * sesión y devuelve una respuesta JSON indicando éxito. Si no, responde con un 
 * mensaje de error.
 *
 * @details
 * - Verifica si el usuario ya tiene una sesión activa.
 * - Consulta la base de datos para validar las credenciales.
 * - Utiliza `password_verify` para validar contraseñas encriptadas.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note Este script depende de `database.php` para la conexión con la base de datos.
 *
 * @par Parámetros de entrada (POST):
 * @param email string Email del usuario.
 * @param contrasena string Contraseña del usuario.
 *
 * @par Respuesta JSON:
 * @retval message string Mensaje indicando el resultado del proceso.
 * @retval error bool Indica si hubo un error (true) o si la operación fue exitosa (false).
 *
 * @par Ejemplo de entrada:
 * ```json
 * {
 *   "email": "usuario@example.com",
 *   "contrasena": "password123"
 * }
 * ```
 *
 * @par Ejemplo de salida (éxito):
 * ```json
 * {
 *   "message": "Inicio de sesión exitoso",
 *   "error": false
 * }
 * ```
 *
 * @par Ejemplo de salida (error):
 * ```json
 * {
 *   "message": "Uno o ambos datos no son correctos",
 *   "error": true
 * }
 * ```
 */

session_start();

// Inicializa la respuesta por defecto.
$response = array('message' => '', 'error' => true);

// Verifica si el usuario ya tiene una sesión activa.
if (isset($_SESSION['user_id'])) {
    // Si está autenticado, redirige a la página principal.
    header('Location: ../html/index.html');
    exit();
}

// Incluye el archivo de conexión a la base de datos.
require_once("database.php");

// Verifica si los campos de email y contraseña están llenos.
if (!empty($_POST['email']) && !empty($_POST['contrasena'])) {
    // Prepara la consulta para buscar al usuario por email.
    $records = $conn->prepare('SELECT email, contrasena FROM usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']); // Asocia el parámetro de email.
    $records->execute(); // Ejecuta la consulta.
    $results = $records->fetch(PDO::FETCH_ASSOC); // Obtiene los resultados.

    // Verifica si se encontró un usuario y si la contraseña es correcta.
    if ($results && password_verify($_POST['contrasena'], $results['contrasena'])) {
        // Credenciales válidas: establece la sesión y prepara la respuesta.
        $_SESSION['user_id'] = $results['email'];
        $response['error'] = false;
        $response['message'] = "Inicio de sesión exitoso";
    } else {
        // Credenciales inválidas: prepara un mensaje de error.
        $response['message'] = "Uno o ambos datos no son correctos";
    }
} else {
    // Faltan campos obligatorios: prepara un mensaje de error.
    $response['message'] = "Por favor, complete todos los campos.";
}

// Configura la cabecera para devolver un JSON y envía la respuesta.
header('Content-Type: application/json');
echo json_encode($response);
?>
