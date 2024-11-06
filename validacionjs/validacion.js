document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let valid = true;
    
    // Validación Nombre Completo
    const nombre = document.getElementById("nombre");
    const errorNombre = document.getElementById("errorNombre");
    if (!/^[a-zA-Z\s]{3,}$/.test(nombre.value)) {
        valid = false;
        nombre.classList.add("error");
        errorNombre.style.display = "block";
    } else {
        nombre.classList.remove("error");
        errorNombre.style.display = "none";
    }

    // Validación Correo Electrónico
    const correo = document.getElementById("correo");
    const errorCorreo = document.getElementById("errorCorreo");
    const correoPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoPattern.test(correo.value)) {
        valid = false;
        correo.classList.add("error");
        errorCorreo.style.display = "block";
    } else {
        correo.classList.remove("error");
        errorCorreo.style.display = "none";
    }

    // Validación Contraseña
    const contrasena = document.getElementById("contrasena");
    const errorContrasena = document.getElementById("errorContrasena");
    const contrasenaPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$/;
    if (!contrasenaPattern.test(contrasena.value)) {
        valid = false;
        contrasena.classList.add("error");
        errorContrasena.style.display = "block";
    } else {
        contrasena.classList.remove("error");
        errorContrasena.style.display = "none";
    }

    // Validación Confirmación de Contraseña
    const confirmacionContrasena = document.getElementById("confirmacionContrasena");
    const errorConfirmacion = document.getElementById("errorConfirmacion");
    if (contrasena.value !== confirmacionContrasena.value) {
        valid = false;
        confirmacionContrasena.classList.add("error");
        errorConfirmacion.style.display = "block";
    } else {
        confirmacionContrasena.classList.remove("error");
        errorConfirmacion.style.display = "none";
    }

    // Validación Teléfono
    const telefono = document.getElementById("telefono");
    const errorTelefono = document.getElementById("errorTelefono");
    if (!/^\d{10,15}$/.test(telefono.value)) {
        valid = false;
        telefono.classList.add("error");
        errorTelefono.style.display = "block";
    } else {
        telefono.classList.remove("error");
        errorTelefono.style.display = "none";
    }

    // Validación Edad
    const edad = document.getElementById("edad");
    const errorEdad = document.getElementById("errorEdad");
    if (edad.value < 18) {
        valid = false;
        edad.classList.add("error");
        errorEdad.style.display = "block";
    } else {
        edad.classList.remove("error");
        errorEdad.style.display = "none";
    }

    // Validación Términos y Condiciones
    const terminos = document.getElementById("terminos");
    const errorTerminos = document.getElementById("errorTerminos");
    if (!terminos.checked) {
        valid = false;
        errorTerminos.style.display = "block";
    } else {
        errorTerminos.style.display = "none";
    }

    if (valid) {
        alert("Formulario enviado con éxito.");
        // Aquí puedes enviar el formulario, como al servidor
        document.getElementById("registrationForm").submit();
    }
});
