function filterOrders(status) {
    const orders = document.querySelectorAll('.order-item');
    orders.forEach(order => {
        if (status === 'All' || order.getAttribute('data-status') === status) {
            order.style.display = 'block';
        } else {
            order.style.display = 'none';
        }
    });
}

function searchOrders() {
    const input = document.getElementById('search-input').value.toLowerCase();
    const orders = document.querySelectorAll('.order-item');
    orders.forEach(order => {
        const name = order.getAttribute('data-name').toLowerCase();
        if (name.includes(input)) {
            order.style.display = 'block';
        } else {
            order.style.display = 'none';
        }
    });
}
