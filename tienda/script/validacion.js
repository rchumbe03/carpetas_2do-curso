document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const nombreInput = document.querySelector('input[name="nombre"]');
    const correoInput = document.querySelector('input[name="correo"]');
    const contrasenaInput = document.querySelector('input[name="contrasena"]');
    const nombreErr = document.querySelector('.nombre-error');
    const correoErr = document.querySelector('.correo-error');
    const contrasenaErr = document.querySelector('.contrasena-error');
    const contrasenaMinLengthText = document.querySelector('.text-box-right:nth-of-type(1)');
    const contrasenaNumberText = document.querySelector('.text-box-right:nth-of-type(2)');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Validar nombre
        if (nombreInput.value.trim() === "") {
            nombreErr.textContent = "El nombre es obligatorio";
            valid = false;
        } else if (nombreInput.value.length > 15) {
            nombreErr.textContent = "El nombre no puede tener más de 15 caracteres";
            valid = false;
        } else {
            nombreErr.textContent = "";
        }

        // Validar correo electrónico
        const correo = correoInput.value.trim();
        if (correo === "") {
            correoErr.textContent = "El correo electrónico es obligatorio";
            valid = false;
        } else if (!correo.endsWith("@gmail.com") && !correo.endsWith("@hotmail.com")) {
            correoErr.textContent = "El correo electrónico debe ser @gmail.com o @hotmail.com";
            valid = false;
        } else {
            correoErr.textContent = "";
        }

        // Validar contraseña
        const contrasena = contrasenaInput.value.trim();
        if (contrasena === "") {
            contrasenaErr.textContent = "La contraseña es obligatoria";
            valid = false;
        } else {
            contrasenaErr.textContent = "";
        }

        if (contrasena.length < 8) {
            contrasenaMinLengthText.classList.add('error-text');
            valid = false;
        } else {
            contrasenaMinLengthText.classList.remove('error-text');
        }

        if (!/[1-9]/.test(contrasena)) {
            contrasenaNumberText.classList.add('error-text');
            valid = false;
        } else {
            contrasenaNumberText.classList.remove('error-text');
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});