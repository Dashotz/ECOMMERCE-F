document.addEventListener('DOMContentLoaded', () => {
    

    const orderList = document.getElementById('order-list');

    orders.forEach(order => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${order.orderNumber}</td>
            <td>${order.placeOn}</td>
            <td>${order.items}</td>
            <td>${order.total}</td>
            <td><button class="manage-button">Manage</button></td>
        `;

        orderList.appendChild(row);
    });
});
