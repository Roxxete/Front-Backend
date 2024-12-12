<?php
/**
 * @file cerrarsesion.php
 * @brief Maneja el cierre de sesión de un usuario.
 *
 * Este script cierra la sesión activa del usuario eliminando todas las variables de sesión,
 * destruyendo la sesión y redirigiendo al usuario a la página de inicio de sesión.
 *
 * @details
 * - Llama a `session_start()` para acceder a la sesión activa.
 * - Usa `session_unset()` para limpiar todas las variables de sesión.
 * - Usa `session_destroy()` para destruir la sesión completamente.
 * - Redirige al usuario a la página de inicio de sesión (`../html/login.html`).
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note Este script debe ser llamado cuando un usuario decide cerrar sesión de la aplicación.
 *
 * @par Ejemplo de uso:
 * - Simplemente incluye este archivo como un enlace o acción de formulario para cerrar sesión.
 * ```html
 * <a href="cerrarsesion.php">Cerrar sesión</a>
 * ```
 *
 * @par Redirección:
 * Después de cerrar la sesión, el usuario será llevado a `../html/login.html`.
 */

// Inicia la sesión para acceder a la sesión activa
session_start();

// Limpia todas las variables de sesión
session_unset();

// Destruye la sesión actual
session_destroy();

// Redirige al usuario a la página de inicio de sesión
header('Location: ../html/login.html');
exit(); // Asegura que no se ejecute código adicional después de la redirección
?>
