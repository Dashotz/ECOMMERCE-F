document.addEventListener('DOMContentLoaded', () => {
    const orders = [
        {
            orderNumber: '72397597187851',
            placeOn: '11/9/2023',
            items: 'Lorem ipsum myr mulaligt, nesâna sulig, dysâs ohun, jot poliyer.',
            total: '₱500'
        },
        {
            orderNumber: '57209107835701',
            placeOn: '18/4/2023',
            items: 'Lorem ipsum tebel ulfranar även om redesamma.',
            total: '₱100'
        }
    ];

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
