document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // Limpiar errores previos
    document.getElementById("email-error").style.display = "none";
    document.getElementById("username-error").style.display = "none";
    document.getElementById("password-error").style.display = "none";
    document.getElementById("confirm-password-error").style.display = "none";

    // Validar la contraseña
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById("password-error").textContent = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
        document.getElementById("password-error").style.display = "block";
        return;
    }

    // Validar que las contraseñas coincidan
    if (password !== confirmPassword) {
        document.getElementById("confirm-password-error").textContent = "Las contraseñas no coinciden.";
        document.getElementById("confirm-password-error").style.display = "block";
        return;
    }

});
