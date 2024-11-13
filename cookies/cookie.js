// Función para crear una cookie
function crearCookie(nombre, valor, dias) {
    let fecha = new Date();
    fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
    let expiracion = "expires=" + fecha.toUTCString();
    document.cookie = nombre + "=" + valor + ";" + expiracion + ";path=/";
    console.log(`Cookie "${nombre}" creada.`);
}

// Función para ver una cookie
function verCookie(nombre) {
    let nombreEQ = nombre + "=";
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(nombreEQ) === 0) {
            return cookie.substring(nombreEQ.length);
        }
    }
    return `Cookie "${nombre}" no encontrada.`;
}

// Función para modificar una cookie
function modificarCookie(nombre, nuevoValor, dias) {
    if (verCookie(nombre) !== `Cookie "${nombre}" no encontrada.`) {
        crearCookie(nombre, nuevoValor, dias);
        console.log(`Cookie "${nombre}" modificada.`);
    } else {
        console.log(`Cookie "${nombre}" no existe y no puede ser modificada.`);
    }
}

// Función para borrar una cookie
function borrarCookie(nombre) {
    if (verCookie(nombre) !== `Cookie "${nombre}" no encontrada.`) {
        document.cookie = nombre + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        console.log(`Cookie "${nombre}" borrada.`);
    } else {
        console.log(`Cookie "${nombre}" no existe y no puede ser borrada.`);
    }
}

// Pruebas de funcionalidad
// Crear una cookie con un tiempo de vencimiento de 1 día
crearCookie('usuario', 'Juan', 1);
console.log(verCookie('usuario')); // Debe mostrar el valor de la cookie "Juan"

// Modificar el valor de la cookie
modificarCookie('usuario', 'Pedro', 1);
console.log(verCookie('usuario')); // Debe mostrar el nuevo valor "Pedro"

// Borrar la cookie
borrarCookie('usuario');
console.log(verCookie('usuario')); // Debe indicar que la cookie no se encontró
