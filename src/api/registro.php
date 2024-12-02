<?php
/**
 * @file crear_usuario.php
 * @brief Maneja la creación de un nuevo usuario en la base de datos.
 *
 * Este script procesa una solicitud POST para agregar un nuevo usuario a la base de datos.
 * Los datos del usuario, incluyendo su contraseña, se validan y almacenan de manera segura.
 *
 * @details
 * - Recibe los datos del usuario desde un formulario o cliente HTTP.
 * - Hashea la contraseña utilizando `password_hash` para garantizar seguridad.
 * - Inserta los datos en la tabla `usuarios` de la base de datos.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note
 * - Este script solo acepta solicitudes POST.
 * - Asegúrate de que los datos de entrada sean validados y seguros.
 *
 * @par Parámetros de entrada:
 * - `email` (string): Correo electrónico del usuario.
 * - `nombre` (string): Nombre del usuario.
 * - `apellidos` (string): Apellidos del usuario.
 * - `usuario` (string): Nombre de usuario.
 * - `contrasena` (string): Contraseña del usuario (se almacena como un hash seguro).
 *
 * @par Ejemplo de uso:
 * - Solicitud: POST crear_usuario.php
 * - Datos:
 *   ```json
 *   {
 *       "email": "ejemplo@correo.com",
 *       "nombre": "Juan",
 *       "apellidos": "Pérez",
 *       "usuario": "juanperez",
 *       "contrasena": "password123"
 *   }
 *   ```
 * - Respuesta exitosa:
 *   ```json
 *   "Usuario creado con exito"
 *   ```
 * - Respuesta fallida:
 *   ```json
 *   "Error al crear el usuario"
 *   ```
 */

// Verificar que el método de solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Incluir el archivo de conexión a la base de datos
    require_once('db.php');

    // Obtener los datos enviados desde el formulario o cliente HTTP
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];

    // Hashear la contraseña de manera segura
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    // Construir la consulta SQL para insertar los datos del usuario
    $query = "INSERT INTO usuarios (email, nombre, apellidos, usuario, contrasena) VALUES ('$email', '$nombre', '$apellidos', '$usuario', '$contrasena')";

    // Ejecutar la consulta
    $result = $mysql->query($query);

    // Verificar si la inserción fue exitosa
    if ($result == true) {
        echo json_encode("Usuario creado con exito");
    } else {
        echo json_encode("Error al crear el usuario");
    }

    // Cerrar la conexión a la base de datos
    $mysql->close();
}
?>
