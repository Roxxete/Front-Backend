<?php
/**
 * @file verificar_sesion.php
 * @brief Verifica si un usuario tiene una sesión activa.
 *
 * Este script maneja la verificación de sesión de un usuario. Si existe una sesión activa,
 * retorna el identificador del usuario asociado. De lo contrario, retorna `null`.
 *
 * @details
 * - Inicia o continúa una sesión existente utilizando `session_start`.
 * - Comprueba si la variable de sesión `user_id` está configurada.
 * - Retorna el valor de `user_id` si está configurado, o `null` en caso contrario.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note
 * - Este script puede ser utilizado para comprobar el estado de inicio de sesión 
 *   en una aplicación cliente.
 *
 * @par Respuesta del script:
 * - Si existe una sesión activa:
 *   ```plaintext
 *   [ID del usuario]
 *   ```
 * - Si no existe una sesión activa:
 *   ```plaintext
 *   null
 *   ```
 * 
 * @par Ejemplo de uso:
 * - Llamada al script: `GET verificar_sesion.php`
 * - Respuesta si hay sesión activa:
 *   ```
 *   12345
 *   ```
 * - Respuesta si no hay sesión activa:
 *   ```
 *   null
 *   ```
 */

// Iniciar o continuar una sesión existente
session_start();

// Verificar si la sesión contiene el identificador del usuario
if (isset($_SESSION['user_id'])) {
    // Retornar el ID del usuario si la sesión está activa
    echo $_SESSION['user_id'];
} else {
    // Retornar 'null' si no hay sesión activa
    echo 'null';
}
?>
