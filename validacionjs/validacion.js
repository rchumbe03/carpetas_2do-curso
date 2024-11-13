document.getElementById("registroForm").addEventListener("submit", function (event) {
    event.preventDefault();
    if (validarFormulario()) {
        alert("Formulario enviado correctamente.");
    }
});

function validarFormulario() {
    let esValido = true;

    esValido &= validarCampo("nombre", /^[a-zA-Z\s]{3,}$/, "El nombre completo es obligatorio y debe contener solo letras y al menos 3 caracteres.");
    esValido &= validarCampo("email", /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/, "Introduzca un correo electrónico válido.");
    esValido &= validarCampo("password", /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/, "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.");
    esValido &= validarConfirmacion("confirmPassword", "password", "La confirmación de contraseña no coincide.");
    esValido &= validarCampo("telefono", /^\d{10,15}$/, "El número de teléfono debe tener entre 10 y 15 dígitos.");
    esValido &= validarCampo("edad", /^(1[89]|[2-9]\d)$/, "Debes ser mayor de 18 años para registrarte.");
    esValido &= validarCheckbox("terminos", "Debes aceptar los términos y condiciones para registrarte.");

    return Boolean(esValido);
}

function validarCampo(id, regex, mensajeError) {
    const campo = document.getElementById(id);
    const error = document.getElementById(id + "Error");
    if (!regex.test(campo.value)) {
        mostrarError(campo, error, mensajeError);
        return false;
    }
    ocultarError(campo, error);
    return true;
}

function validarConfirmacion(id, idOriginal, mensajeError) {
    const campo = document.getElementById(id);
    const campoOriginal = document.getElementById(idOriginal);
    const error = document.getElementById(id + "Error");
    if (campo.value !== campoOriginal.value) {
        mostrarError(campo, error, mensajeError);
        return false;
    }
    ocultarError(campo, error);
    return true;
}

function validarCheckbox(id, mensajeError) {
    const campo = document.getElementById(id);
    const error = document.getElementById(id + "Error");
    if (!campo.checked) {
        mostrarError(campo, error, mensajeError);
        return false;
    }
    ocultarError(campo, error);
    return true;
}

function mostrarError(campo, error, mensaje) {
    campo.classList.add("error");
    error.textContent = mensaje;
    error.style.display = "block";
}

function ocultarError(campo, error) {
    campo.classList.remove("error");
    error.style.display = "none";
}
