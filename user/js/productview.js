// productview.js

const SHIPPING_FEE = 10; // Define the shipping fee

document.getElementById('add-to-cart-button').addEventListener('click', function() {
    const productName = document.querySelector('.product-info h2').innerText;
    const productPrice = parseFloat(document.querySelector('.product-price').innerText.replace('$', ''));
    const quantity = parseInt(document.getElementById('quantity').value);
    const selectedFlavor = document.querySelector('.flavors .selected') ? document.querySelector('.flavors .selected').innerText : 'N/A';
    const selectedSize = document.querySelector('.sizes .selected') ? document.querySelector('.sizes .selected').innerText : 'N/A';

    // Calculate total price including shipping fee
    const totalPrice = (productPrice * quantity) + SHIPPING_FEE;

    const productDetails = {
        name: productName,
        price: totalPrice, // Total price including shipping fee
        quantity: quantity,
        flavor: selectedFlavor,
        size: selectedSize
    };

    // Store product details in localStorage
    localStorage.setItem('cart', JSON.stringify(productDetails));

    // Redirect to addtocart.php
    window.location.href = 'addtocart.php';
});

function decreaseQuantity() {
    let quantity = parseInt(document.getElementById('quantity').value);
    if (quantity > 1) {
        document.getElementById('quantity').value = quantity - 1;
    }
}

function increaseQuantity() {
    let quantity = parseInt(document.getElementById('quantity').value);
    document.getElementById('quantity').value = quantity + 1;
}

// Handle flavor option selection
const flavorOptions = document.querySelectorAll('.flavor-option');
flavorOptions.forEach(option => {
    option.addEventListener('click', function() {
        flavorOptions.forEach(btn => btn.classList.remove('selected'));
        this.classList.add('selected');
    });
});

// Handle size option selection
const sizeOptions = document.querySelectorAll('.size-option');
sizeOptions.forEach(option => {
    option.addEventListener('click', function() {
        sizeOptions.forEach(btn => btn.classList.remove('selected'));
        this.classList.add('selected');
    });
});

// Accordion functionality
const accordionButtons = document.querySelectorAll('.accordion-button');
accordionButtons.forEach(button => {
    button.addEventListener('click', function() {
        const content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
});
