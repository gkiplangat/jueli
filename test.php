<?php
// Start session and include config
require_once 'admin/config.php';

// Initialize variables
$products = [];
$categories = [];
$error_message = '';
$current_category = isset($_GET['category']) ? $_GET['category'] : 'all';

try {
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Get categories
    $category_query = "SELECT DISTINCT product_category FROM products";
    $category_result = $conn->query($category_query);

    if ($category_result === false) {
        throw new Exception("Category query error: " . $conn->error);
    }

    $categories = $category_result->fetch_all(MYSQLI_ASSOC);

    // Get products
    if ($current_category === 'all') {
        $product_query = "SELECT * FROM products";
        $stmt = $conn->prepare($product_query);
    } else {
        $product_query = "SELECT * FROM products WHERE product_category = ?";
        $stmt = $conn->prepare($product_query);
        $stmt->bind_param('s', $current_category);
    }

    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    $error_message = "We're experiencing technical difficulties. Please check back later.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jueli Engineering Ltd</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
    .hero-section {
        height: 60vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        background: url('img/bg_2.jpg') center/cover no-repeat;
        color: white;
        text-align: center;
    }

    .nav-link.active {
        color: white !important;
        font-weight: 600;
        border-bottom: 2px solid #FFA500;
    }
    </style>

</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003366;">
            <div class="container">
                <a class="navbar-brand logo" href="index.php">JUELI <span>ENGINEERING LTD</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="shop.php">SHOP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">

        </div>
    </section>

    <!-- Contact Us -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <p><strong>Address:</strong></p>
                                <p>15976-00100, Nairobi Industrial Area, Kenya</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <p><strong>Phone:</strong></p>
                                <p>+254 704 553 400</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <p><strong>Email:</strong></p>
                                <p>info@jueliengineeringltd.co.ke</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <p><strong>Working Hours:</strong></p>
                                <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                                <p>Saturday: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form>
                        <input type="text" placeholder="Your Name" required>
                        <input type="email" placeholder="Your Email" required>
                        <input type="text" placeholder="Subject">
                        <textarea placeholder="Your Message" required></textarea>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>JUELI ENGINEERING LTD</h3>
                    <p>Engineering Solutions for a Sustainable Future. Providing innovative, cost-efficient, and
                        high-quality engineering services across multiple sectors.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="about.php">About Us</a></li>

                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Our Services</h3>
                    <ul>
                        <li><a href="#">Mechanical Services</a></li>
                        <li><a href="#">Steel Fabrication</a></li>
                        <li><a href="#">HVAC Systems</a></li>
                        <li><a href="#">Plumbing & Piping</a></li>
                        <li><a href="#">Lift Installation</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contact Info</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Nairobi Industrial Area, Kenya</li>
                        <li><i class="fas fa-phone-alt"></i> +254 704 553 400</li>
                        <li><i class="fas fa-envelope"></i>info@jueliengineeringltd.co.ke</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 JUELI ENGINEERING LTD. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING%20LTD,%20I%20have%20an%20inquiry%20about%20your%20products"
        class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp fa-lg"></i>
    </a>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Product modal functionality
        const productModal = document.getElementById('productModal');
        if (productModal) {
            productModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const name = button.getAttribute('data-name');
                const description = button.getAttribute('data-description');
                const image = button.getAttribute('data-image');
                const category = button.getAttribute('data-category');

                document.getElementById('productModalTitle').textContent = name;
                document.getElementById('productModalName').textContent = name;
                document.getElementById('productModalCategory').textContent = category;
                document.getElementById('productModalDescription').textContent = description;
                document.getElementById('productModalImage').src = image;

                // Set up WhatsApp inquiry link
                const whatsappBtn = document.getElementById('whatsappInquiry');
                const message =
                    `Hello JUELI ENGINEERING, I'm interested in your ${name} (${category}) product. Could you please share the price and details?`;
                whatsappBtn.href = `https://wa.me/254704553400?text=${encodeURIComponent(message)}`;
            });
        }

        // Update dropdown button text when a category is selected
        const categoryDropdown = document.getElementById('categoryDropdown');
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                categoryDropdown.textContent = this.textContent;
            });
        });
    });
    </script>
</body>

</html>