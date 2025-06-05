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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUELI ENGINEERING LTD - Engineering Solutions for a Sustainable Future</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your existing stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header -->

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003366;">
            <div class="container">
                <a class="navbar-brand logo" href="index.php">JUELI <span>ENGINEERING</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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

    <!-- Hero Slider -->
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
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php elseif (empty($categories)): ?>
            <div class="alert alert-info">No product categories found.</div>
            <?php else: ?>
            <div class="category-slider">
                <?php foreach ($categories as $category): ?>
                <div class="category-slide">
                    <div class="category-card">
                        <div class="category-img"
                            style="height: 150px; overflow: hidden; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
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
                                alt="<?php echo htmlspecialchars($category['category_name']); ?>"
                                style="max-height: 100%; max-width: 100%; object-fit: contain; padding: 10px;">
                            <?php else: ?>
                            <img src="uploads/default.jpg"
                                alt="<?php echo htmlspecialchars($category['category_name']); ?>"
                                style="max-height: 100%; max-width: 100%; object-fit: contain; padding: 10px;">
                            <?php endif; ?>
                        </div>
                        <h3 style="color: #003366; margin-top: 10px;">
                            <?php echo htmlspecialchars($category['category_name']); ?></h3>
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

    <!-- Rest of your existing code -->
    <!-- Featured Products Slider - Matching Categories Style -->
    <section class="category-slider-section" id="featuredSlider">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>

            <?php
            // Fetch featured products from database
            $featured_products = [];
            try {
                $query = "SELECT * FROM featured_products";
                $stmt = $conn->query($query);
                $featured_products = $stmt->fetch_all(MYSQLI_ASSOC);
            } catch (Exception $e) {
                error_log("Database error: " . $e->getMessage());
                $featured_error = "We're experiencing technical difficulties loading featured products.";
            }
            ?>

            <?php if (isset($featured_error)): ?>
            <div class="alert alert-danger"><?php echo $featured_error; ?></div>
            <?php elseif (empty($featured_products)): ?>
            <div class="alert alert-info">No featured products found.</div>
            <?php else: ?>
            <div class="category-slider">
                <?php foreach ($featured_products as $product): ?>
                <div class="category-slide">
                    <div class="category-card">
                        <div class="category-img"
                            style="height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background: #f8f9fa;">
                            <?php
                                    $imagePath = !empty($product['product_picture']) ? 'uploads/' . $product['product_picture'] : 'img/products/default.jpg';
                                    ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                                style="max-height: 100%; max-width: 100%; object-fit: contain; padding: 10px;">
                        </div>
                        <div class="product-info">
                            <h3 style="color: #003366;"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <p class="product-description">
                                <?php echo htmlspecialchars($product['product_description']); ?></p>
                            <div class="price-contact">
                                <a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING,%20I'm%20interested%20in%20your%20<?php echo urlencode($product['product_name']); ?>%20product.%20Could%20you%20please%20share%20the%20price%20and%20details?"
                                    class="whatsapp-btn" style="background:#003366;" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Ask for Price
                                </a>
                            </div>
                        </div>
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



    <!-- Our Services -->
    <section class="services-section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="service-info">
                        <h3>Mechanical Services</h3>
                        <p>Design, installation, and ongoing maintenance of mechanical systems for various
                            applications.
                        </p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="service-info">
                        <h3>Steel Structure Design & Fabrication</h3>
                        <p>Providing top-quality steel structures tailored for residential, commercial, and
                            industrial
                            applications.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-wind"></i>
                    </div>
                    <div class="service-info">
                        <h3>HVAC Systems</h3>
                        <p>Delivering energy-efficient heating, ventilation, and air conditioning systems for all
                            building types.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tint"></i>
                    </div>
                    <div class="service-info">
                        <h3>Plumbing & Piping Solutions</h3>
                        <p>Comprehensive installation and maintenance of plumbing and piping systems for water, gas,
                            and
                            waste.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div class="service-info">
                        <h3>Welding & MIG Fabrication</h3>
                        <p>Specializing in precision welding for construction and heavy-duty applications.</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-elevator"></i>
                    </div>
                    <div class="service-info">
                        <h3>Lift Installation Services</h3>
                        <p>Complete lift design, installation, and maintenance for residential and commercial
                            buildings.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Partners 
    <section class="partners-section">
        <div class="container">
            <h2 class="section-title">Our Partners</h2>
            <div class="partners-grid">
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x80?text=Partner+1" alt="Partner 1">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x80?text=Partner+2" alt="Partner 2">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x80?text=Partner+3" alt="Partner 3">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x80?text=Partner+4" alt="Partner 4">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x80?text=Partner+5" alt="Partner 5">
                </div>
            </div>
        </div>
    </section>-->

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
                                <p>muchuieliud04@gmail.com</p>
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
                    <h3>JUELI ENGINEERING</h3>
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
                        <li><a href="index.html">Home</a></li>
                        <li><a href="shop.html">Shop</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
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
                        <li><i class="fas fa-envelope"></i> muchuieliud04@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 JUELI ENGINEERING LTD. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Add Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Your existing scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Your existing JavaScript code
    });
    </script>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ... (keep your existing hero slider and mobile menu code) ...

    // Category Slider - Fixed Version
    const slider = document.querySelector('.category-slider');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');

    if (slider && prevBtn && nextBtn) {
        // Calculate slide width dynamically based on first slide
        const firstSlide = slider.querySelector('.category-slide');
        const slideWidth = firstSlide ? firstSlide.offsetWidth + 15 : 175; // 15px for gap

        function updateButtons() {
            // Show/hide buttons based on scroll position
            prevBtn.classList.toggle('hidden', slider.scrollLeft <= 10);
            nextBtn.classList.toggle('hidden',
                slider.scrollLeft >= slider.scrollWidth - slider.clientWidth - 10);
        }

        function scrollToPosition(position) {
            slider.scrollTo({
                left: position,
                behavior: 'smooth'
            });
        }

        prevBtn.addEventListener('click', () => {
            const newPos = slider.scrollLeft - (slideWidth * 3);
            scrollToPosition(Math.max(newPos, 0));
        });

        nextBtn.addEventListener('click', () => {
            const newPos = slider.scrollLeft + (slideWidth * 3);
            const maxScroll = slider.scrollWidth - slider.clientWidth;
            scrollToPosition(Math.min(newPos, maxScroll));
        });

        // Update buttons on scroll and resize
        slider.addEventListener('scroll', updateButtons);
        window.addEventListener('resize', updateButtons);

        // Initialize button states
        updateButtons();

        // Debugging logs
        console.log('Slider initialized:', {
            sliderWidth: slider.clientWidth,
            scrollWidth: slider.scrollWidth,
            slideWidth: slideWidth,
            scrollLeft: slider.scrollLeft
        });
    } else {
        console.error('Slider elements not found:', {
            slider,
            prevBtn,
            nextBtn
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all sliders on page
    const sliders = [{
            slider: document.querySelector('.category-slider'),
            prevBtn: document.querySelector('#categorySlider .slider-prev'),
            nextBtn: document.querySelector('#categorySlider .slider-next')
        },
        {
            slider: document.querySelector('.featured-slider'),
            prevBtn: document.querySelector('#featuredSlider .slider-prev'),
            nextBtn: document.querySelector('#featuredSlider .slider-next')
        }
    ];

    sliders.forEach(({
        slider,
        prevBtn,
        nextBtn
    }) => {
        if (slider && prevBtn && nextBtn) {
            const firstSlide = slider.querySelector('.category-slide') || slider.querySelector(
                '.featured-slide');
            const slideWidth = firstSlide ? firstSlide.offsetWidth + 20 : 300; // 20px for gap

            function updateButtons() {
                prevBtn.classList.toggle('disabled', slider.scrollLeft <= 10);
                nextBtn.classList.toggle('disabled',
                    slider.scrollLeft >= slider.scrollWidth - slider.clientWidth - 10);
            }

            function scrollToPosition(position) {
                slider.scrollTo({
                    left: position,
                    behavior: 'smooth'
                });
            }

            prevBtn.addEventListener('click', () => {
                const newPos = slider.scrollLeft - (slideWidth * 3);
                scrollToPosition(Math.max(newPos, 0));
            });

            nextBtn.addEventListener('click', () => {
                const newPos = slider.scrollLeft + (slideWidth * 3);
                const maxScroll = slider.scrollWidth - slider.clientWidth;
                scrollToPosition(Math.min(newPos, maxScroll));
            });

            slider.addEventListener('scroll', updateButtons);
            window.addEventListener('resize', updateButtons);
            updateButtons();
        }
    });
});
</script>
</body>

</html>