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

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo_2.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo_2.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo_2.png">
    <link rel="manifest" href="img/logo_2.png">
    <link rel="mask-icon" href="img/logo_2.png" color="#003366">
    <meta name="msapplication-TileColor" content="#003366">
    <meta name="theme-color" content="#003366">

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
                            <a class="nav-link" href="contact.php">CONTACT US</a>
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

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Category Dropdown -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoryDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $current_category === 'all' ? 'All Products' : htmlspecialchars($current_category); ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <li><a class="dropdown-item <?php echo $current_category === 'all' ? 'active' : ''; ?>"
                                href="shop.php?category=all&page=1">All Products</a></li>
                        <?php foreach ($categories as $category): ?>
                        <li><a class="dropdown-item <?php echo $current_category === $category['product_category'] ? 'active' : ''; ?>"
                                href="shop.php?category=<?php echo urlencode($category['product_category']); ?>&page=1">
                                <?php echo htmlspecialchars($category['product_category']); ?>
                            </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="row" id="products-container">
            <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php elseif (empty($products)): ?>
            <div class="col-12">
                <div class="alert alert-info">No products found in this category.</div>
            </div>
            <?php else: ?>
            <?php
                // Pagination setup
                $itemsPerPage = 12;
                $totalItems = count($products);
                $totalPages = ceil($totalItems / $itemsPerPage);
                $currentPage = isset($_GET['page']) ? max(1, min($totalPages, (int)$_GET['page'])) : 1;
                $offset = ($currentPage - 1) * $itemsPerPage;
                $paginatedProducts = array_slice($products, $offset, $itemsPerPage);

                foreach ($paginatedProducts as $product): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">
                    <div class="product-img"
                        style="height: 150px; overflow: hidden; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
                        <?php
                                $imagePath = !empty($product['product_picture']) ? 'uploads/' . $product['product_picture'] : 'img/products/default.jpg';
                                ?>
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" class="img-fluid"
                            alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                            style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="color: #003366;">
                            <?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <p class="card-text"><small
                                class="text-muted"><?php echo htmlspecialchars($product['product_category']); ?></small>
                        </p>
                        <p class="card-text">
                            <?php echo htmlspecialchars($product['product_description'] ?? 'No description available'); ?>
                        </p>
                        <button class="btn btn-primary view-details" data-bs-toggle="modal"
                            data-bs-target="#productModal"
                            data-name="<?php echo htmlspecialchars($product['product_name']); ?>"
                            data-description="<?php echo htmlspecialchars($product['product_description'] ?? 'No description available'); ?>"
                            data-image="<?php echo htmlspecialchars($imagePath); ?>"
                            data-category="<?php echo htmlspecialchars($product['product_category']); ?>">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <!-- Previous Page Link -->
                <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="?category=<?php echo urlencode($current_category); ?>&page=<?php echo $currentPage - 1; ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                    <a class="page-link"
                        href="?category=<?php echo urlencode($current_category); ?>&page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php endfor; ?>

                <!-- Next Page Link -->
                <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">
                    <a class="page-link"
                        href="?category=<?php echo urlencode($current_category); ?>&page=<?php echo $currentPage + 1; ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" id="productModalImage" class="img-fluid rounded" alt="Product Image"
                                style="max-height: 400px; object-fit: contain;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="productModalName" style="color: #003366;"></h4>
                            <p class="text-muted" id="productModalCategory"></p>
                            <p id="productModalDescription"></p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="#" id="whatsappInquiry" class="btn btn-success">
                                    <i class="fab fa-whatsapp"></i> Contact for Price
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <li><a href="contact.php">Contact Us</a></li>
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