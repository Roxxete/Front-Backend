# Front-Backend
Proyecto biometría

# Pasarela de Pago

Esta pestaña consiste en una pasarela de pago simple que permite a los usuarios ingresar su información de pago de manera segura. La página está construida con HTML, CSS y JavaScript, y está diseñada para ser fácil de usar y accesible.

## Funcionalidades

1. **Formulario de Pago**: 
   - El formulario solicita la siguiente información:
     - **Nombre Completo**: Solo se permiten letras y espacios. Se valida para asegurar que no se ingresen números ni caracteres especiales.
     - **Número de Tarjeta**: Se permiten solo números, y el campo está restringido a una longitud de entre 13 y 18 dígitos.
     - **Fecha de Expiración**: Utiliza un selector de mes para ingresar la fecha de expiración de la tarjeta.
     - **CVV**: Se permite solo un código de 3 dígitos.
   
2. **Validaciones en Tiempo Real**: 
   - Se implementan validaciones para asegurar que los datos ingresados sean correctos antes de enviar el formulario. Si hay errores en la entrada, se muestra un mensaje de error debajo del campo correspondiente.
   - Se utilizan expresiones regulares para validar el formato del nombre, el número de tarjeta y el CVV.

3. **Estilo Responsivo**: 
   - La página se adapta a diferentes tamaños de pantalla y tiene un diseño limpio y moderno. El formulario está centrado y utiliza un fondo claro para facilitar la lectura.

## Estructura del Proyecto

- **pasarelapago.html**: Este archivo contiene el marcado HTML para la pasarela de pago.
- **pasareladepago.css**: Este archivo contiene el estilo CSS que define la apariencia de la página.
