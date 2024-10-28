# Proyecto de Aplicación Web

## Descripción
Este proyecto es una aplicación web que incluye funcionalidades de autenticación de usuarios, almacenamiento y recuperación de datos en una base de datos, y envío de correos electrónicos mediante PHPMailer.

## Contenidos

### Estructura de Carpetas y Archivos Principales
- `index.html`: Página principal.
- `login.html` y `login.php`: Manejan el inicio de sesión.
- `registro.html`, `registro.php`, `registro.js`, `registro.css`: Archivos para el registro de nuevos usuarios.
- `database.php`, `db.php`: Configuración de la base de datos.
- `guardarMedicion.php`: Almacena datos en la base de datos.
- `recuperarMedicion.php`: Recupera datos de la base de datos.
- `send.php`: Script para enviar correos desde el servidor.
- `enviarEmail.js`: Script de envío de correos desde el cliente.
- `logout.php`: Maneja el cierre de sesión.
- `verificarcodigo.html`: Página para verificación de códigos.

### PHPMailer
La carpeta `phpmailer` contiene todos los archivos necesarios para enviar correos electrónicos desde la aplicación, así como archivos de traducción para mensajes de error y configuraciones.

## Configuración
1. **Base de datos**: Configurar los archivos `database.php` y `db.php` con las credenciales de la base de datos.
2. **PHPMailer**: Actualizar las configuraciones en `send.php` y otros scripts de correo con las credenciales de SMTP necesarias.

## Uso
- **Autenticación**: `login.php`, `logout.php`, `registro.php`
- **Datos de usuario**: `guardarMedicion.php`, `recuperarMedicion.php`
- **Correos electrónicos**: `send.php`, `enviarEmail.js`

## Requerimientos
- Servidor Apache o similar con soporte para PHP.
- Base de datos MySQL o compatible.
- Configuración de un servidor SMTP para el envío de correos.

## Créditos
Incluye la biblioteca PHPMailer para el manejo de correos electrónicos.
