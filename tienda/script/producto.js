document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.add-button');
    const globalQuantityFrame = document.getElementById('global-quantity-frame');
    let currentProductId = null;

    addButtons.forEach(button => {
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