// script.js
console.log("El archivo script.js se ha cargado correctamente.");
function cambiarImagen(ruta, titulo) {
    const imgPreview = document.getElementById("imgPreview");
    const imgTitle = document.getElementById("imgTitle");

    if (imgPreview && imgTitle) {
        imgPreview.src = ruta;
        imgTitle.textContent = titulo;
    }
}

function abrirEnNuevaVentana() {
    const imgPreview = document.getElementById("imgPreview").src;
    window.open(imgPreview, "_blank");
}
