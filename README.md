# 🛒 Shop.co - Pet Supplies E-Commerce Platform

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

**A full-featured e-commerce platform for pet supplies built with PHP and MySQL**

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Project Structure](#-project-structure) • [Database](#-database)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🎯 Overview

**Shop.co** is a comprehensive e-commerce platform specializing in pet supplies. The platform offers a seamless shopping experience for pet owners to browse, purchase, and manage their pet care products online. With both customer-facing and administrative interfaces, the system provides complete e-commerce functionality including product management, order processing, analytics, and user account management.

### Key Highlights

- 🐾 **Pet-Focused**: Specialized in pet supplies (food, treats, medicine)
- 🛍️ **Full Shopping Experience**: Browse, cart, checkout, and order tracking
- 📊 **Admin Dashboard**: Comprehensive analytics and management tools
- 👤 **User Accounts**: Profile management, address book, order history
- 📱 **Responsive Design**: Modern UI with mobile-friendly layouts

---

## ✨ Features

### 🛒 Customer Features

- **Product Browsing**
  - Category-based product navigation (Dry Food, Wet Food, Treats, Medicine)
  - Product search and filtering
  - Featured products showcase
  - Product detail pages with images

- **Shopping Cart**
  - Add/remove items from cart
  - Update quantities
  - Persistent cart sessions

- **Checkout & Payment**
  - Secure checkout process
  - Multiple address management
  - Payment processing
  - Order confirmation

- **User Account**
  - User registration and authentication
  - Profile management
  - Order history and tracking
  - Address book management
  - Password recovery

### 👨‍💼 Admin Features

- **Dashboard**
  - Sales analytics and charts
  - Recent orders overview
  - Revenue statistics
  - User activity metrics

- **Product Management**
  - Add new products
  - Edit existing products
  - Delete products
  - Product image management

- **Order Management**
  - View all orders
  - Order status updates
  - Generate receipts
  - Order analytics

- **Customer Management**
  - View customer list
  - Customer details
  - Customer analytics

- **Analytics**
  - Sales charts and graphs
  - Order analytics
  - User growth charts
  - Revenue reports

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **PHP** | Server-side scripting and backend logic |
| **MySQL/MariaDB** | Database management |
| **JavaScript** | Frontend interactivity and AJAX |
| **CSS3** | Styling and responsive design |
| **HTML5** | Markup and structure |
| **Chart.js** | Data visualization for analytics |
| **Font Awesome** | Icons and UI elements |

---

## 📦 Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL/MariaDB 10.4 or higher
- Apache/Nginx web server
- phpMyAdmin (optional, for database management)

### Step-by-Step Setup

1. **Clone or Download the Repository**
   ```bash
   git clone <repository-url>
   cd ECOMMERCE-F
   ```

2. **Database Setup**
   - Open phpMyAdmin or MySQL command line
   - Import the database file:
     ```sql
     source db/ecommerce_db.sql
     ```
   - Or import `db/ecommerce_db.sql` through phpMyAdmin interface

3. **Configure Database Connection**
   - Open `inc/db.php`
   - Update database credentials:
     ```php
     $servername = "localhost";
     $username = "root";        // Your MySQL username
     $password = "";            // Your MySQL password
     $dbname = "ecommerce_db";  // Database name
     ```

4. **Set Up Web Server**
   - **XAMPP/WAMP/MAMP**: Place project in `htdocs` or `www` folder
   - **Apache**: Configure virtual host pointing to project directory
   - **Nginx**: Configure server block

5. **File Permissions** (Linux/Mac)
   ```bash
   chmod -R 755 productimg/
   chmod -R 755 admin/productimg/
   chmod -R 755 user/
   ```

6. **Access the Application**
   - Open browser and navigate to: `http://localhost/ECOMMERCE-F`
   - Or your configured domain/virtual host

---

## ⚙️ Configuration

### Database Configuration

Edit `inc/db.php` with your database credentials:

```php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "ecommerce_db";
```

### Session Configuration

The application uses PHP sessions for user authentication. Ensure sessions are properly configured in `php.ini`.

### File Upload Configuration

For product image uploads, ensure PHP upload settings in `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

---

## 🚀 Usage

### For Customers

1. **Browse Products**
   - Visit the homepage to see featured products
   - Navigate through categories
   - Click on products to view details

2. **Add to Cart**
   - Select products and quantities
   - Add items to shopping cart
   - Review cart before checkout

3. **Checkout**
   - Login or register for an account
   - Add/select delivery address
   - Complete payment process
   - Receive order confirmation

4. **Manage Account**
   - View order history
   - Update profile information
   - Manage delivery addresses

### For Administrators

1. **Access Admin Panel**
   - Navigate to `/admin/dashboard.php`
   - Login with admin credentials

2. **Manage Products**
   - Add new products via `addproducts.php`
   - Edit products via `editproduct.php`
   - View all products in `products.php`

3. **Process Orders**
   - View orders in `orders.php`
   - Update order status
   - Generate receipts

4. **View Analytics**
   - Check dashboard for overview
   - View detailed analytics in `analytics.php`
   - Review sales charts and reports

---

## 📁 Project Structure

```
ECOMMERCE-F/
│
├── admin/                    # Admin panel files
│   ├── css/                  # Admin stylesheets
│   ├── js/                   # Admin JavaScript files
│   ├── chart/                # Chart components
│   ├── productimg/           # Admin product images
│   ├── dashboard.php         # Admin dashboard
│   ├── products.php          # Product management
│   ├── orders.php            # Order management
│   ├── customers.php         # Customer management
│   ├── analytics.php         # Analytics page
│   └── ...
│
├── assets/                   # Static assets (images, icons)
├── css/                      # Frontend stylesheets
├── js/                       # Frontend JavaScript files
├── img/                      # Product and category images
├── productimg/               # Product images
├── slider/                   # Homepage slider images
├── user/                     # User-uploaded content
│
├── inc/                      # Include files
│   ├── db.php               # Database connection
│   ├── nav.php              # Navigation component
│   ├── nav1.php             # Secondary navigation
│   └── slideshow.php        # Homepage slideshow
│
├── db/                       # Database files
│   └── ecommerce_db.sql     # Database schema and data
│
├── index.php                 # Homepage
├── productpage.php          # Product listing page
├── productview.php          # Product detail page
├── addtocart.php            # Shopping cart page
├── checkout.php             # Checkout page
├── payments.php             # Payment processing
├── orders.php               # User orders page
├── profile.php              # User profile
├── login.php                # Login page
├── register.php             # Registration page
├── footer.php               # Footer component
└── README.md                # This file
```

---

## 🗄️ Database Schema

The application uses the following main tables:

### Core Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts and authentication |
| `products` | Product catalog with details |
| `cart_items` | Shopping cart items |
| `orders` | Order information |
| `addresses` | User delivery addresses |
| `payments` | Payment transaction records |

### Key Relationships

- `orders.user_id` → `users.id`
- `cart_items.user_id` → `users.id`
- `cart_items.product_id` → `products.id`
- `addresses.user_id` → `users.id`

---

## 📸 Screenshots

### Homepage
- Featured products showcase
- Category navigation
- Product slideshow

### Product Pages
- Product listings with filters
- Detailed product views
- Shopping cart integration

### Admin Dashboard
- Sales analytics
- Order management
- Product administration

---

## 🔒 Security Considerations

⚠️ **Important Security Notes:**

- Change default database credentials
- Implement prepared statements for all database queries
- Add input validation and sanitization
- Implement CSRF protection
- Use secure password hashing (bcrypt/argon2)
- Enable HTTPS in production
- Regular security updates

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

---

## 👥 Authors

- **Development Team** - Initial work

---

## 🙏 Acknowledgments

- Font Awesome for icons
- Google Fonts (Poppins) for typography
- Chart.js for data visualization
- All contributors and users

---

## 📞 Support

For support, email support@shop.co or open an issue in the repository.

---

<div align="center">

**Made with ❤️ for pet lovers**

⭐ Star this repo if you find it helpful!

</div>

