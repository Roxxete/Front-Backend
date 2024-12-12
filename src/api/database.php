<?php
/**
 * @file database.php
 * @brief Establece la conexión con la base de datos utilizando PDO.
 *
 * Este script crea una conexión a la base de datos utilizando las credenciales proporcionadas 
 * y gestiona errores de conexión con un manejo adecuado de excepciones.
 *
 * @details
 * - Configura los parámetros de conexión como servidor, usuario, contraseña y base de datos.
 * - Utiliza `PDO` para facilitar las operaciones con la base de datos.
 * - Implementa un bloque `try-catch` para capturar y manejar errores de conexión.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note
 * - Este script debe ser incluido en otros scripts que requieran acceso a la base de datos.
 * - Asegúrate de mantener las credenciales seguras y no exponer este archivo públicamente.
 *
 * @par Parámetros de configuración:
 * @param server string Dirección del servidor de la base de datos (por defecto: 'localhost').
 * @param username string Nombre de usuario para acceder a la base de datos.
 * @param password string Contraseña para acceder a la base de datos.
 * @param database string Nombre de la base de datos.
 *
 * @par Ejemplo de conexión:
 * ```php
 * require_once("database.php");
 * // $conn se usará para ejecutar consultas en la base de datos
 * ```
 *
 * @par Salida:
 * Si la conexión falla, se termina el script y se muestra un mensaje de error.
 */

$server = 'localhost';   // Dirección del servidor de la base de datos
$username = 'root';      // Usuario de la base de datos
$password = '';          // Contraseña del usuario
$database = 'bio';       // Nombre de la base de datos

try {
    // Crear una instancia de PDO para conectarse a la base de datos
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);

    // Configuración opcional para PDO (puedes agregar más según sea necesario)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de errores
} catch (PDOException $e) {
    // Capturar errores de conexión y mostrar un mensaje amigable
    die('Connection Failed: ' . $e->getMessage());
}
?>
