<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("db.php");

    // Obtener datos de la solicitud
    $old_contrasena = $_POST['old-contrasena'];
    $new_contrasena = $_POST['new-contrasena'];
    $confirm_contrasena = $_POST['confirm-contrasena'];
    $usuario_id = $_POST['usuario_id'];  // Suponiendo que se pasa un ID de usuario en la solicitud

    // Consultar la base de datos para obtener la contraseña actual
    $query = "SELECT contrasena FROM usuarios WHERE email = '$usuario_id'";
    $result = $mysql->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_old_contrasena = $row['contrasena'];

        // Verificar que la contraseña antigua coincide con la base de datos
        if (password_verify($old_contrasena, $hashed_old_contrasena)) {
            // Verificar si las nuevas contraseñas coinciden
            if ($new_contrasena === $confirm_contrasena) {
                // Hashear la nueva contraseña
                $new_contrasena_hash = password_hash($new_contrasena, PASSWORD_BCRYPT);

                // Actualizar la contraseña en la base de datos
                $update_query = "UPDATE usuarios SET contrasena = '$new_contrasena_hash' WHERE email = '$usuario_id'";
                $update_result = $mysql->query($update_query);

                if ($update_result) {
                    echo json_encode("La contraseña se actualizó correctamente");
                } else {
                    echo json_encode("Error al actualizar la contraseña");
                }
            } else {
                echo json_encode("Las nuevas contraseñas no coinciden");
            }
        } else {
            echo json_encode("La contraseña actual no es correcta");
        }
    } else {
        echo json_encode("Usuario no encontrado");
    }

    $mysql->close();
}
?>
