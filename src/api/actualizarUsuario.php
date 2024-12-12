<?php
/**
 * @file actualizarUsuario.php
 * @brief Maneja la actualización de los datos de un usuario.
 *
 * Este script permite actualizar la información de un usuario en la base de datos,
 * como nombre, apellidos, nombre de usuario y correo electrónico.
 *
 * @details
 * - Actualiza los campos `nombre`, `apellidos`, `usuario` y `email` de un usuario existente.
 * - Identifica al usuario mediante su correo electrónico antiguo (`emailantiguo`).
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note Este script depende de:
 * - `db.php` para la conexión con la base de datos.
 *
 * @par Parámetros de entrada (POST):
 * @param email string Nuevo correo electrónico del usuario.
 * @param emailantiguo string Correo electrónico actual del usuario (para identificarlo en la base de datos).
 * @param nombre string Nuevo nombre del usuario.
 * @param apellidos string Nuevos apellidos del usuario.
 * @param usuario string Nuevo nombre de usuario.
 *
 * @par Respuesta JSON:
 * @retval "El usuario se actualizó correctamente" Indica éxito en la operación.
 * @retval "Fallo" Error al ejecutar la consulta de actualización.
 *
 * @par Ejemplo de entrada:
 * ```json
 * {
 *   "email": "nuevo_email@example.com",
 *   "emailantiguo": "email_actual@example.com",
 *   "nombre": "Nuevo Nombre",
 *   "apellidos": "Nuevos Apellidos",
 *   "usuario": "NuevoUsuario"
 * }
 * ```
 *
 * @par Ejemplo de salida (éxito):
 * ```json
 * "El usuario se actualizó correctamente"
 * ```
 *
 * @par Ejemplo de salida (error):
 * ```json
 * "Fallo"
 * ```
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    require_once("db.php");

    // Obtención de datos de la solicitud POST
    $email = $_POST['email']; // Nuevo correo electrónico del usuario
    $emailantiguo = $_POST['emailantiguo']; // Correo electrónico actual para identificar al usuario
    $nombre = $_POST['nombre']; // Nuevo nombre del usuario
    $apellidos = $_POST['apellidos']; // Nuevos apellidos del usuario
    $usuario = $_POST['usuario']; // Nuevo nombre de usuario

    // Consulta SQL para actualizar los datos del usuario
    $query = "UPDATE usuarios 
              SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', email = '$email' 
              WHERE email = '$emailantiguo'";

    $result = $mysql->query($query);

    // Verificar si la operación fue exitosa
    if ($result == true) {
        echo json_encode("El usuario se actualizó correctamente");
    } else {
        echo "Fallo"; // Indica que hubo un error en la consulta
    }

    // Cerrar la conexión a la base de datos
    $mysql->close();
}
?>
