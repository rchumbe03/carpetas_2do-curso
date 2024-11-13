// Función para crear o modificar una cookie
function setCookie(nombre, valor, dias) {
    let fecha = new Date();
    fecha.setTime(fecha.getTime() + (dias * 24 * 60 * 60 * 1000));
    document.cookie = `${nombre}=${valor}; expires=${fecha.toUTCString()}; path=/`;
}

// Función para obtener el valor de una cookie
function getCookie(nombre) {
    let cookieArr = document.cookie.split(';');
    for (let cookie of cookieArr) {
        cookie = cookie.trim();
        if (cookie.startsWith(nombre + '=')) {
            return cookie.split('=')[1];
        }
    }
    return `Cookie "${nombre}" no encontrada.`;
}

// Función para borrar una cookie
function deleteCookie(nombre) {
    setCookie(nombre, '', -1);
    console.log(`Cookie "${nombre}" borrada.`);
}

// Pruebas de funcionalidad
setCookie('usuario', 'Juan', 1);
console.log(getCookie('usuario')); // Debe mostrar "Juan"

setCookie('usuario', 'Pedro', 1);
console.log(getCookie('usuario')); // Debe mostrar "Pedro"

deleteCookie('usuario');
console.log(getCookie('usuario')); // Debe indicar que la cookie no se encontró