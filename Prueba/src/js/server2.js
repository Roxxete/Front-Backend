async function enviarcorreoverificar() {
    $(document).ready(async function () {
        var email = document.getElementById('email').value;
        var nombre = document.getElementById('name').value;
        var apellidos = document.getElementById('lastname').value;
        var contrasena = document.getElementById('password').value;
        var usuario = document.getElementById('username').value;
        var confirmarcontrasenya = document.getElementById('confirm-password').value;
        var terminosCheckbox = document.getElementById("agree-term");


        var codigo = Math.floor(10000000 + Math.random() * 90000000);
        var numeroCodificado = btoa(codigo.toString());

        if (email === "" || nombre === "" || contrasena === "" || apellidos === "" || confirmarcontrasenya === "" || usuario === "") {
            alert("Por favor, complete todos los campos.");
            return;
        }
        if (contrasena !== confirmarcontrasenya) {
            alert("La confirmación de la contraseña no coincide.");
            return;
        } if (!terminosCheckbox.checked) {
            alert("Debes aceptar los términos y condiciones para registrarte.");
            return; // Detiene el envío del formulario si los términos no están aceptados
        }
        $.ajax({
            url: '../api/send.php',
            type: 'POST',
            data: { email: email, numeroCodificado: numeroCodificado, codigo: codigo, nombre: btoa(nombre), contrasena: btoa(contrasena), apellidos: btoa(apellidos), emailc: btoa(email), usuario: btoa(usuario) },
            dataType: 'json',
            success: async function (data) {
                if (!data.error) {
                    alert(data.message);
                } else {
                    alert('Error: ' + data.message);
                }
            },
            error: function () {
                console.log('Error al obtener el valor.');
                console.log(arguments);
            }
        });
    });
}

async function comprobarCodigo() {
    $(document).ready(async function() {
        var codigo1 = document.getElementById("verification-code").value;       
        var url = window.location.href;
        var searchParams = new URLSearchParams(new URL(url).search);
        var codigoURL = atob(searchParams.get('codigo'));
        if(codigo1==codigoURL){
            var email = atob(searchParams.get('email'));
            var nombre = atob(searchParams.get('nombre'));
            var apellidos = atob(searchParams.get('apellidos'));
            var usuario = atob(searchParams.get('usuario'));
            var contrasena = atob(searchParams.get('contrasena'));
            registro(email, nombre, apellidos, usuario, contrasena);
        }
        else {
            alert("El código de verificación no coincide.");
        }
    })
}

async function registro(email, nombre, apellidos, usuario, contrasena){
    $(document).ready(async function() {
        $.ajax({
            url: '../api/registro.php',
            type: 'POST',
            data: { email: email, nombre: nombre, apellidos: apellidos, usuario: usuario, contrasena: contrasena },
            dataType:'json', 
            success: async function(data) {
                alert("El usuario se ha creado correctamente");
                window.location.href = "../html/login.html";
                },
                error: function() {
                    console.log('Error al obtener el valor.');
                    console.log(arguments);
                }
        })
    })
}

function login() {

    $(document).ready(function () {

        const email = document.getElementById("email").value;
        const contrasena = document.getElementById("contrasena").value;
        console.log(email + " "+ contrasena);
        $.ajax({
            url: '../api/login.php', // Ruta al script PHP que maneja el inicio de sesión
            type: 'POST',
            data: {
                email: email,
                contrasena: contrasena
            },
            success: async function (data) {
                if (!data.error) {
                    if (email == "admin@gmail.com") {
                        window.location.href = "../html/admin.html";
                    }
                    else {
                        window.location.href = "../html/index.html";
                    }
                    //alert(data.message); // Display the success message
                } else {
                    alert('Error: ' + data.message); // Display the error message
                }
            },
            error: function () {
                console.log('Error al obtener el valor.');
                console.log(arguments);
            }
        });
    });
}
async function obtenerUserId() {
    const response = await fetch('../api/userid.php'); // Ruta al script PHP que obtiene $_SESSION['user_id']

    if (response.ok) {
        const userId = await response.text();

        if (userId !== 'null') {
            // El valor de $_SESSION['user_id'] se ha recuperado con éxito
            return userId;
        } else {
            // No se encontró $_SESSION['user_id']
            return null;
        }
    } else {
        // Error en la solicitud AJAX
        console.error('Error al obtener $_SESSION[\'user_id\'].');
        return null;
    }
}
async function recuperarusuario() {
    $(document).ready(async function () {
        // Hacer la solicitud al servidor
        const userId = await obtenerUserId();
        if (userId !== null) {
            $.ajax({
                url: '../api/recuperarUsuario.php', // Ruta al script PHP
                type: 'GET',
                data: { email: userId },
                dataType: 'json',
                success: async function (data) {
                    // Manejar la respuesta del servidor
                    console.log(data);
                    document.getElementById('usuario').value = data.usuario;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('apellidos').value = data.apellidos;
                    document.getElementById('correo').value = data.email;
                },
                error: function () {
                    console.log('Error al obtener el valor.');
                    console.log(arguments);
                }
            });
        }
    })
}
function actualizarUsuario() {

    // Espera a que el DOM esté listo antes de ejecutar la función
    $(document).ready(async function () {
        const password = document.getElementById("password").value;
        console.log(password)
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!passwordRegex.test(password)) {
            alert("La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.")
            return;
        }
        // Obtén el ID o identificador único del usuario (si es necesario)
        const userId = await obtenerUserId();

        if (userId !== null) {
            // Recoge los datos del formulario
            const usuario = document.getElementById('usuario').value;
            const nombre = document.getElementById('nombre').value;
            const apellidos = document.getElementById('apellidos').value;
            const email = document.getElementById('correo').value;
            const contrasena = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            // Verificar que la contraseña y la confirmación coincidan
            if (contrasena !== confirmPassword) {
                alert("Las contraseñas no coinciden.");
                return;
            }
            // Realizar la solicitud AJAX para actualizar el usuario
            
                $.ajax({
                    url: '../api/actualizarUsuario.php', // Ruta al script PHP
                    type: 'POST',
                    data: {
                        emailantiguo: userId, // Suponiendo que `userId` es el correo electrónico
                        usuario: usuario,
                        nombre: nombre,
                        apellidos: apellidos,
                        email: email,
                        contrasena: contrasena
                    },
                    dataType: 'json',
                    success: async function(data){ 
                        console.log(data) 
                        alert("El usuario se ha actulizado correctamente")
                        window.location.href = "../html/index.html";

                    }, error:function(){
                        console.log("Error al obtener valor")
                        console.log(arguments)
                    }
                });

        }
    });
}
function actualizarContraseña() {
    $(document).ready(async function () {
    // Obtener los valores del formulario
    const oldPassword = document.getElementById('old-password').value;
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // Validación de contraseñas
    if (newPassword !== confirmPassword) {
       alert("Las contraseñas no coinciden")
        return;
    }

    // Obtener el ID del usuario (puedes pasarlo desde el servidor o guardarlo en un atributo oculto)
    const usuarioId = await obtenerUserId(); // Cambia esto por el ID real del usuario
    // Crear el objeto de datos para enviar en la solicitud
    const formData = new FormData();
    formData.append('old-contrasena', oldPassword);
    formData.append('new-contrasena', newPassword);
    formData.append('confirm-contrasena', confirmPassword);
    formData.append('usuario_id', usuarioId);

    // Realizar la solicitud Ajax
    $.ajax({
        url: '../api/actualizarContraseña.php', // Asegúrate de poner la URL correcta
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            const data = JSON.parse(response);
            alert(data);  // Mostrar el mensaje que devuelve PHP
            window.location.href = "../html/editarUsuario.html";
            
        },
        error: function() {
            alert('Hubo un error en la actualización de la contraseña');
        }
    });
})
}
