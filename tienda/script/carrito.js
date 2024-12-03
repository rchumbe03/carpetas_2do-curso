document.addEventListener('DOMContentLoaded', function() {
    const removeButtons = document.querySelectorAll('.remove-button');
    const globalQuantityFrame = document.getElementById('global-quantity-frame');
    let currentProductId = null;

    removeButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            currentProductId = this.getAttribute('data-product-id');
            const quantityElement = document.getElementById('quantity');
            quantityElement.textContent = '1';
            const rect = this.getBoundingClientRect();
            globalQuantityFrame.style.top = `${rect.bottom + window.scrollY}px`;
            globalQuantityFrame.style.left = `${rect.left + window.scrollX}px`;
            globalQuantityFrame.style.display = 'block';
        });
    });

    document.addEventListener('click', function(event) {
        if (!globalQuantityFrame.contains(event.target)) {
            globalQuantityFrame.style.display = 'none';
        }
    });

    globalQuantityFrame.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    document.querySelector('.confirm-button').addEventListener('click', function() {
        const quantity = parseInt(document.getElementById('quantity').textContent);
        fetch('funcion_php/update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: currentProductId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cantidad actualizada en el carrito');
                globalQuantityFrame.style.display = 'none';
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert('Error al actualizar la cantidad en el carrito: ' + data.error);
                console.error('Error:', data.error);
            }
        });
    });
});

function increaseQuantity() {
    const quantityElement = document.getElementById('quantity');
    let quantity = parseInt(quantityElement.textContent);
    quantity++;
    quantityElement.textContent = quantity;
}

function decreaseQuantity() {
    const quantityElement = document.getElementById('quantity');
    let quantity = parseInt(quantityElement.textContent);
    if (quantity > 1) {
        quantity--;
        quantityElement.textContent = quantity;
    }
}