document.addEventListener('DOMContentLoaded', function() {
    const removeButtons = document.querySelectorAll('.remove-button');

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            // Lógica para eliminar el producto del carrito
            fetch(`remove_from_cart.php?product_id=${productId}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Eliminar el producto del DOM
                    this.closest('.custom-frame').remove();
                } else {
                    alert('Error al eliminar el producto del carrito.');
                }
            });
        });
    });
});