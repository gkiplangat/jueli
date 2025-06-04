<?php
// Start session and include config at the very top
session_start();
require_once 'admin/config.php';

// Fetch categories from database
$categories = [];
try {
    $query = "SELECT * FROM product_categories";
    $stmt = $conn->query($query);
    $categories = $stmt->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    // Log error and display user-friendly message
    error_log("Database error: " . $e->getMessage());
    $error_message = "We're experiencing technical difficulties. Please check back later.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUELI ENGINEERING LTD</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003366;">
            <div class="container">
                <button class="navbar-toggler order-first" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand fw-bold mx-auto order-lg-1" href="index.php">JUELI <span>ENGINEERING</span></a>

                <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <!-- Hero Slider Section -->
    <section class="hero-slider">
        <div class="slide active"
            style="background-image: url('https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
            <div class="slide-content">
                <h2>Our Vision</h2>
                <p>Delivering high-quality mechanical services and steel fabrication for industrial and commercial
                    projects.</p>
            </div>
        </div>
        <div class="slide"
            style="background-image: url('https://images.unsplash.com/photo-1581093057305-3ec4e7b874e9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
            <div class="slide-content">
                <h2>Mission Statement</h2>
                <p>To offer exceptional, innovative, and dependable engineering services.</p>
            </div>
        </div>
        <div class="slide"
            style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
            <div class="slide-content">
                <h2>Core Values</h2>
                <p>Integrity, Excellence, Innovation, Customer Centricity.</p>
            </div>
        </div>
    </section>

    <!-- Product Categories Slider -->
    <section class="category-slider-section" id="categorySlider">
        <div class="container">
            <h2 class="section-title">Our Product Categories</h2>

            <?php if (isset($error_message)): ?>
            <div class="error-notice"><?php echo $error_message; ?></div>
            <?php elseif (empty($categories)): ?>
            <div class="notice">No product categories found.</div>
            <?php else: ?>
            <div class="category-slider">
                <?php foreach ($categories as $category): ?>
                <div class="category-slide">
                    <div class="category-card">
                        <div class="category-img">
                            <?php
                                    // Check multiple possible field names
                                    $imageField = isset($category['picture']) ? 'picture' : (isset($category['image']) ? 'image' : (isset($category['photo']) ? 'photo' : ''));

                                    if (!empty($imageField) && !empty($category[$imageField])):
                                        $imagePath = $category[$imageField];
                                        // Add base path if needed
                                        if (!filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                            $imagePath = 'uploads/' . $imagePath;
                                        }
                                    ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                alt="<?php echo htmlspecialchars($category['category_name']); ?>">
                            <?php else: ?>
                            <img src="uploads/default.jpg"
                                alt="<?php echo htmlspecialchars($category['category_name']); ?>">
                            <?php endif; ?>
                        </div>
                        <h3><?php echo htmlspecialchars($category['category_name']); ?></h3>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="slider-nav">
                <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
            </div>
            <?php endif; ?>
        </div>
    </section>





    <!--Bootstrap 5 JS Bundle with Popper-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>