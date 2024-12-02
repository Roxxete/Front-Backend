<?php
/**
 * @file db.php
 * @brief Establece una conexión con la base de datos utilizando MySQLi.
 *
 * Este script configura y establece una conexión con una base de datos MySQL 
 * utilizando la extensión `MySQLi` de PHP.
 *
 * @details
 * - Configura los parámetros de conexión como servidor, usuario, contraseña y base de datos.
 * - Verifica si la conexión fue exitosa y maneja errores adecuadamente.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note
 * - Este script es ideal para incluir en otros scripts que necesitan acceder a la base de datos.
 * - Asegúrate de que los valores de configuración sean correctos y seguros.
 *
 * @par Parámetros de configuración:
 * @param host string Dirección del servidor de la base de datos (por defecto: 'localhost').
 * @param username string Nombre de usuario para la base de datos (por defecto: 'root').
 * @param password string Contraseña del usuario (por defecto: cadena vacía).
 * @param database string Nombre de la base de datos (por defecto: 'bio').
 *
 * @par Ejemplo de uso:
 * ```php
 * require_once("db.php");
 * // Ahora puedes usar $mysql para realizar consultas
 * ```
 *
 * @par Salida:
 * Si la conexión falla, se detendrá la ejecución del script y se mostrará un mensaje de error.
 */

// Crear una conexión MySQLi con los parámetros de configuración
$mysql = new mysqli(
    "localhost", // Dirección del servidor de la base de datos
    "root",      // Usuario de la base de datos
    "",          // Contraseña del usuario
    "bio"        // Nombre de la base de datos
);

// Verificar si la conexión fue exitosa
if ($mysql->connect_error) {
    // Mostrar mensaje de error y detener la ejecución si ocurre un fallo
    die("Failed to connection: " . $mysql->connect_error);
}
?>
