function checkout() {
    const paymentMethod = document.getElementById('payment').value;
    const totalAmount = document.getElementById('total').textContent.replace('$', '');

    // Example: Retrieve other order details as needed from your HTML elements

    const orderDetails = {
        name: 'Product Name', // Example: Replace with actual product name
        size: 'Product Size', // Example: Replace with actual product size
        flavor: 'Product Flavor', // Example: Replace with actual product flavor
        quantity: 1, // Example: Replace with actual quantity
        total: parseFloat(totalAmount), // Example: Replace with actual total amount
        payment_method: paymentMethod,
        status: 'Pending' // Example: Replace with initial status
    };

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'checkout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Handle success (e.g., redirect to order confirmation page)
                alert('Order placed successfully!');
                location.reload(); // Example: Reload page or redirect
            } else {
                // Handle error
                alert('Failed to place order: ' + response.error);
            }
        } else {
            // Handle error
            alert('Failed to connect to server.');
        }
    };
    xhr.send(JSON.stringify({ order_details: orderDetails }));
}
