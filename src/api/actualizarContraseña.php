<?php
/**
 * @file actualizarContrasena.php
 * @brief Maneja la actualización de contraseñas de los usuarios.
 *
 * Este script permite a los usuarios cambiar su contraseña actual por una nueva. 
 * Realiza varias verificaciones de seguridad, como validar la contraseña actual, 
 * confirmar que las nuevas contraseñas coincidan, y almacenar la nueva contraseña de manera segura.
 *
 * @details
 * - Verifica que la contraseña actual proporcionada coincida con la almacenada en la base de datos.
 * - Compara las contraseñas nueva y de confirmación.
 * - Almacena la nueva contraseña usando `password_hash` para mayor seguridad.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note Este script depende de:
 * - `db.php` para la conexión con la base de datos.
 * - Extensiones PHP como `password_hash` y `password_verify`.
 *
 * @par Parámetros de entrada (POST):
 * @param old-contrasena string Contraseña actual del usuario.
 * @param new-contrasena string Nueva contraseña que el usuario desea establecer.
 * @param confirm-contrasena string Confirmación de la nueva contraseña.
 * @param usuario_id string Identificador único del usuario (por ejemplo, su email).
 *
 * @par Respuesta JSON:
 * @retval "La contraseña se actualizó correctamente" Indica éxito en la operación.
 * @retval "Error al actualizar la contraseña" Error al ejecutar la consulta de actualización.
 * @retval "Las nuevas contraseñas no coinciden" Las contraseñas nueva y de confirmación no son iguales.
 * @retval "La contraseña actual no es correcta" La contraseña actual no coincide con la base de datos.
 * @retval "Usuario no encontrado" No se encontró un usuario con el ID proporcionado.
 *
 * @par Ejemplo de entrada:
 * ```json
 * {
 *   "old-contrasena": "password123",
 *   "new-contrasena": "nuevaPassword456",
 *   "confirm-contrasena": "nuevaPassword456",
 *   "usuario_id": "usuario@example.com"
 * }
 * ```
 *
 * @par Ejemplo de salida (éxito):
 * ```json
 * "La contraseña se actualizó correctamente"
 * ```
 *
 * @par Ejemplo de salida (error):
 * ```json
 * "Las nuevas contraseñas no coinciden"
 * ```
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    require_once("db.php");

    // Obtención de datos de la solicitud POST
    $old_contrasena = $_POST['old-contrasena']; // Contraseña actual proporcionada por el usuario
    $new_contrasena = $_POST['new-contrasena']; // Nueva contraseña
    $confirm_contrasena = $_POST['confirm-contrasena']; // Confirmación de la nueva contraseña
    $usuario_id = $_POST['usuario_id']; // Identificador único del usuario (por ejemplo, email)

    // Consulta para obtener la contraseña actual desde la base de datos
    $query = "SELECT contrasena FROM usuarios WHERE email = '$usuario_id'";
    $result = $mysql->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_old_contrasena = $row['contrasena']; // Contraseña encriptada almacenada en la base de datos

        // Verifica que la contraseña actual coincide con la almacenada
        if (password_verify($old_contrasena, $hashed_old_contrasena)) {
            // Comprueba si las nuevas contraseñas coinciden
            if ($new_contrasena === $confirm_contrasena) {
                // Hashea la nueva contraseña para almacenarla de forma segura
                $new_contrasena_hash = password_hash($new_contrasena, PASSWORD_BCRYPT);

                // Actualiza la contraseña en la base de datos
                $update_query = "UPDATE usuarios SET contrasena = '$new_contrasena_hash' WHERE email = '$usuario_id'";
                $update_result = $mysql->query($update_query);

                if ($update_result) {
                    echo json_encode("La contraseña se actualizó correctamente");
                } else {
                    echo json_encode("Error al actualizar la contraseña");
                }
            } else {
                // Las nuevas contraseñas no coinciden
                echo json_encode("Las nuevas contraseñas no coinciden");
            }
        } else {
            // La contraseña actual no coincide con la almacenada
            echo json_encode("La contraseña actual no es correcta");
        }
    } else {
        // No se encontró el usuario con el ID proporcionado
        echo json_encode("Usuario no encontrado");
    }

    // Cierra la conexión a la base de datos
    $mysql->close();
}
?>
