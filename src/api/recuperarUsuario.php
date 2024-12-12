<?php
/**
 * @file obtener_usuario.php
 * @brief Recupera los datos de un usuario según su correo electrónico.
 *
 * Este script maneja una solicitud GET para obtener los detalles de un usuario 
 * desde la base de datos utilizando su dirección de correo electrónico como identificador.
 *
 * @details
 * - Conecta a la base de datos utilizando MySQLi.
 * - Realiza una consulta para buscar un usuario específico por su correo electrónico.
 * - Retorna los datos del usuario en formato JSON si se encuentra, o un mensaje de error si no.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note
 * - Este script solo acepta solicitudes GET.
 * - Los datos se retornan en formato JSON para facilitar el consumo en aplicaciones cliente.
 *
 * @par Parámetros de entrada:
 * - `email` (string): Dirección de correo electrónico del usuario que se desea buscar.
 *
 * @par Ejemplo de uso:
 * - Solicitud: `GET obtener_usuario.php?email=ejemplo@correo.com`
 * - Respuesta exitosa:
 *   ```json
 *   {
 *       "id": 1,
 *       "nombre": "Juan",
 *       "apellidos": "Pérez",
 *       "email": "ejemplo@correo.com",
 *       ...
 *   }
 *   ```
 * - Respuesta fallida:
 *   ```
 *   "Fallo"
 *   ```
 */

// Verificar que el método de solicitud sea GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Incluir el archivo de conexión a la base de datos
    require_once("db.php");

    // Obtener el parámetro 'email' de la solicitud
    $email = $_GET['email'];

    // Consulta para obtener los datos del usuario según el correo electrónico
    $query = "SELECT * FROM usuarios WHERE email = '$email'";

    // Ejecutar la consulta
    $result = $mysql->query($query);

    // Verificar si se encontraron resultados
    if ($mysql->affected_rows > 0) {
        // Almacenar los datos del usuario en un array
        while ($row = $result->fetch_assoc()) {
            $array = $row;
        }
        // Retornar los datos en formato JSON
        echo json_encode($array);
    } else {
        // Retornar mensaje de error si no se encontró el usuario
        echo "Fallo";
    }

    // Cerrar la conexión y liberar recursos
    $result->close();
    $mysql->close();
}
?>
