document.addEventListener('DOMContentLoaded', function() {
    const removeButtons = document.querySelectorAll('.remove-button');

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            // Lógica para eliminar el producto del carrito
            // Puedes hacer una solicitud AJAX para eliminar el producto del carrito en el servidor
            // y luego actualizar la tabla del carrito en el cliente
        });
    });
});