<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawfect Shoppe - Product</title>
    <link rel="stylesheet" href="css/productview.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <!-- Header Section -->
    <header>
    <section class="header">
     <?php include("inc/nav.php"); ?>     
    </section>
    </header>
    
    <?php
    include 'inc/db.php';

    // Fetch the product ID from the query parameter
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $product = null;

    // Fetch product details from the database
    if ($product_id > 0) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        }
        $stmt->close();
    }

    if (!$product) {
        echo "<p>Product not found!</p>";
        exit;
    }

    $conn->close();
    ?>

    <!-- Main Content -->
    <main>
        <div class="breadcrumb">
            <a href="index.php">Home</a> > <a href="#"><?php echo htmlspecialchars($product['variation_type']); ?></a> > <span><?php echo htmlspecialchars($product['name']); ?></span>
        </div>
        <div class="product-detail-container">
            <div class="product-image-container">
                <div class="main-image">
                    <img src="productimg/<?php echo htmlspecialchars($product['img']); ?>" alt="Product Image">
                </div>
                <div class="thumbnail-images">
                    <div class="thumbnail"><img src="productimg/<?php echo htmlspecialchars($product['img']); ?>" alt="Thumbnail Image"></div>
                    <div class="thumbnail"><img src="productimg/<?php echo htmlspecialchars($product['img']); ?>" alt="Thumbnail Image"></div>
                    <div class="thumbnail"><img src="productimg/<?php echo htmlspecialchars($product['img']); ?>" alt="Thumbnail Image"></div>
                </div>
            </div>
            <div class="product-info">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="product-rating">⭐⭐⭐⭐ 4.5/5</p>
                <p class="product-price">$<?php echo htmlspecialchars($product['price']); ?></p>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                <div class="product-options">
                    <div class="flavors">
                        <span>Flavor:</span>
                        <button class="flavor-option" data-flavor="Plain">Plain</button>
                        <button class="flavor-option" data-flavor="Special">Special</button>
                    </div>
                    <div class="sizes">
                        <span>Size:</span>
                        <button class="size-option" data-size="Small">Small</button>
                        <button class="size-option" data-size="Medium">Medium</button>
                        <button class="size-option" data-size="Large">Large</button>
                        <button class="size-option" data-size="XL">XL</button>
                    </div>
                </div>
                <div class="quantity-selector">
                    <button class="quantity-button" onclick="decreaseQuantity()">-</button>
                    <input type="text" id="quantity" value="1" readonly>
                    <button class="quantity-button" onclick="increaseQuantity()">+</button>
                </div>
                <button id="add-to-cart-button" class="add-to-cart-button" onclick="alert('Please Log In First!')">Add to Cart</button>
            </div>
        </div>
        <div class="product-details">
        <div class="accordion">
    <div class="accordion-item">
        <button class="accordion-button">+ About This Item</button>
        <div class="accordion-content">
            <p>About this item details...</p>
        </div>
    </div>
    <div class="accordion-item">
        <button class="accordion-button">+ Details</button>
        <div class="accordion-content">
            <p>Details about the product...</p>
        </div>
    </div>
    <div class="accordion-item">
        <button class="accordion-button">+ Nutritional Information</button>
        <div class="accordion-content">
            <p>Nutritional information...</p>
        </div>
    </div>
    <div class="accordion-item">
        <button class="accordion-button">+ Feeding Instruction</button>
        <div class="accordion-content">
            <p>Feeding instructions...</p>
        </div>
    </div>
</div>

        </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const addToCartButton = document.getElementById('add-to-cart-button');

    addToCartButton.addEventListener('click', () => {
        const sizeElement = document.querySelector('.size-option.selected');
        const flavorElement = document.querySelector('.flavor-option.selected');

        if (!sizeElement || !flavorElement) {
           
            return;
        }

        const product = {
            id: <?php echo json_encode($product['id']); ?>,
            name: <?php echo json_encode($product['name']); ?>,
            size: sizeElement.dataset.size,
            flavor: flavorElement.dataset.flavor,
            quantity: parseInt(document.getElementById('quantity').value),
            img: <?php echo json_encode($product['img']); ?>
        };

        // Send product data to add_to_cart.php via POST request
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(product),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Product added to cart!');
            } else {
                alert('Failed to add product to cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Handle size and flavor selection
    document.querySelectorAll('.size-option').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.size-option').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
        });
    });

    document.querySelectorAll('.flavor-option').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.flavor-option').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
        });
    });

    // Accordion functionality
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            button.classList.toggle('active');

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });
});

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    let quantity = parseInt(quantityInput.value);
    if (quantity > 1) {
        quantityInput.value = quantity - 1;
    }
}

function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    let quantity = parseInt(quantityInput.value);
    quantityInput.value = quantity + 1;
}

    </script>
</body>
</html>
