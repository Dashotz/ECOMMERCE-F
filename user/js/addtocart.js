function calculateTotal() {
    const checkboxes = document.querySelectorAll('.cart-item-checkbox');
    let subtotal = 0;
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const price = parseFloat(checkbox.getAttribute('data-price'));
            const quantity = parseInt(checkbox.getAttribute('data-quantity'));
            subtotal += price * quantity;
        }
    });
    const shippingFee = 10;
    const total = subtotal + shippingFee;
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
    document.getElementById('total-amount').value = total.toFixed(2);
}

function updateQuantity(id, delta) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            location.reload(); // Reload the page after updating
        }
    };
    xhr.send('id=' + id + '&delta=' + delta);
}

function deleteCartItem(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_cart_item.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            location.reload(); // Reload the page after deleting
        }
    };
    xhr.send('id=' + id);
}

document.addEventListener('DOMContentLoaded', function () {
    calculateTotal(); // Calculate total on page load
});
