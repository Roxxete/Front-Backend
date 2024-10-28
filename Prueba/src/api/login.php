<?php
session_start();
$response = array('message' => '', 'error' => true);

if (isset($_SESSION['user_id'])) {
    // Si ya está autenticado, redirige a la página principal
    header('Location: ../html/index.html');
    exit();
}

require_once("database.php");

if (!empty($_POST['email']) && !empty($_POST['contrasena'])) {
    // Consulta para buscar al usuario
    $records = $conn->prepare('SELECT email, contrasena FROM usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    // Verificación de contraseña
    if ($results && password_verify($_POST['contrasena'], $results['contrasena'])) {
        $_SESSION['user_id'] = $results['email'];
        $response['error'] = false;
        $response['message'] = "Inicio de sesión exitoso";
    } else {
        $response['message'] = "Uno o ambos datos no son correctos";
    }
} else {
    $response['message'] = "Por favor, complete todos los campos.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
