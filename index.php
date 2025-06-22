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


// Debug featured products query
$featured_products = [];
$featured_error = null;

try {
    $query = "SELECT * FROM featured_products";
    $stmt = $conn->query($query);

    // Debug: Show the query being executed
    echo "<!-- Query: $query -->";

    if ($stmt) {
        $featured_products = $stmt->fetch_all(MYSQLI_ASSOC);

        // Debug: Show count of fetched products
        echo "<!-- Fetched " . count($featured_products) . " featured products -->";

        // Debug: Show first product data if available
        if (!empty($featured_products)) {
            echo "<!-- First product: " . print_r($featured_products[0], true) . " -->";
        }
    } else {
        $featured_error = "Query failed: " . $conn->error;
        error_log("Featured products query failed: " . $conn->error);
    }
} catch (Exception $e) {
    $featured_error = "Database error: " . $e->getMessage();
    error_log("Featured products error: " . $e->getMessage());
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

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your existing stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
    /* Additional styles for services slider */

    .nav-link.active {
        color: white !important;
        font-weight: 600;
        border-bottom: 2px solid #FFA500;
    }

    .services-slider-section {
        padding: 60px 0;
        background-color: #f8f9fa;
    }

    .services-slider {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        gap: 20px;
        padding: 20px 0;
        margin: 0 -15px;
    }

    .services-slide {
        scroll-snap-align: start;
        flex: 0 0 calc(33.333% - 20px);
        min-width: 300px;
        padding: 0 15px;
    }

    .service-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-5px);
    }

    .service-img {
        height: 200px;
        overflow: hidden;
    }

    .service-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .service-info {
        padding: 20px;
    }

    .service-info h3 {
        color: #003366;
        margin-bottom: 10px;
    }

    .service-info p {
        color: #666;
        font-size: 14px;
    }

    .slider-nav {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .slider-nav button {
        background: #003366;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slider-nav button:hover {
        background: #002244;
    }

    .slider-nav button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .services-slide {
            flex: 0 0 calc(50% - 20px);
            min-width: 250px;
        }
    }

    @media (max-width: 576px) {
        .services-slide {
            flex: 0 0 100%;
        }
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
                            <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">SHOP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Slider -->
    <section class="hero-slider">
        <div class="slide active" style="background-image: url('img/bg_1.jpg');">
            <div class="slide-content">
                <h2>Our Vision</h2>
                <p>Delivering high-quality mechanical services and steel fabrication for industrial and commercial
                    projects.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('img/bg_2.jpg');">
            <div class="slide-content">
                <h2>Mission Statement</h2>
                <p>To offer exceptional, innovative, and dependable engineering services.</p>
            </div>
        </div>
        <div class="slide" style="background-image: url('img/bg_3.jpg');">
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
                                    $imageField = '';
                                    if (isset($category['picture'])) {
                                        $imageField = 'picture';
                                    } elseif (isset($category['image'])) {
                                        $imageField = 'image';
                                    } elseif (isset($category['photo'])) {
                                        $imageField = 'photo';
                                    }

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

    <!-- Featured Products Slider - Matching Categories Style -->
    <section class="featured-slider-section" id="featuredSlider">
        <!-- Changed class name -->
        <div class="container">
            <h2 class="section-title">Featured Products</h2>

            <?php if (isset($featured_error)): ?>
            <div class="error-notice"><?php echo $featured_error; ?></div>
            <?php elseif (empty($featured_products)): ?>
            <div class="notice">No featured products found.</div>
            <?php else: ?>
            <div class="featured-slider">
                <!-- Changed class name -->
                <?php foreach ($featured_products as $product): ?>
                <div class="featured-slide">
                    <!-- Changed class name -->
                    <div class="featured-card">
                        <!-- Changed class name -->
                        <div class="featured-img-container">
                            <!-- Changed class name and added container -->
                            <?php
                                    $imagePath = !empty($product['product_picture']) ? 'uploads/' . $product['product_picture'] : 'img/products/default.jpg';
                                    ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="featured-img">
                            <!-- Added class -->
                        </div>
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
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

    <!-- Our Services Slider -->
    <section class="services-slider-section" id="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>

            <div class="services-slider">
                <div class="services-slide">
                    <div class="service-card">
                        <div class="service-img">
                            <img src="img/mechanic_service.jpg" alt="Mechanical Services">
                        </div>
                        <div class="service-info">
                            <h3>Mechanical Services</h3>
                            <p>Design, installation, and ongoing maintenance of mechanical systems for various
                                applications.</p>
                        </div>
                    </div>
                </div>

                <div class="services-slide">
                    <div class="service-card">
                        <div class="service-img">
                            <img src="img/fabrication.jpg" alt="Steel Fabrication">
                        </div>
                        <div class="service-info">
                            <h3>Steel Structure Design & Fabrication</h3>
                            <p>Providing top-quality steel structures tailored for residential, commercial, and
                                industrial applications.</p>
                        </div>
                    </div>
                </div>

                <div class="services-slide">
                    <div class="service-card">
                        <div class="service-img">
                            <img src="img/hvac.jpg" alt="HVAC Systems">
                        </div>
                        <div class="service-info">
                            <h3>HVAC Systems</h3>
                            <p>Delivering energy-efficient heating, ventilation, and air conditioning systems for all
                                building types.</p>
                        </div>
                    </div>
                </div>

                <div class="services-slide">
                    <div class="service-card">
                        <div class="service-img">
                            <img src="img/plumbing.jpg" alt="Plumbing Services">
                        </div>
                        <div class="service-info">
                            <h3>Plumbing & Piping Solutions</h3>
                            <p>Comprehensive installation and maintenance of plumbing and piping systems for water, gas,
                                and waste.</p>
                        </div>
                    </div>
                </div>

                <div class="services-slide">
                    <div class="service-card">
                        <div class="service-img">
                            <img src="img/welding.jpg" alt="Welding Services">
                        </div>
                        <div class="service-info">
                            <h3>Welding & MIG Fabrication</h3>
                            <p>Specializing in precision welding for construction and heavy-duty applications.</p>
                        </div>
                    </div>
                </div>

                <div class="services-slide">
                    <div class="service-card">
                        <div class="service-img">
                            <img src="img/lift.jpg" alt="Lift Installation">
                        </div>
                        <div class="service-info">
                            <h3>Lift Installation Services</h3>
                            <p>Complete lift design, installation, and maintenance for residential and commercial
                                buildings.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-nav">
                <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
            </div>
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
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="about.php">About Us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Our Services</h3>
                    <ul>
                        <li><a href="#services">Mechanical Services</a></li>
                        <li><a href="#services">Steel Fabrication</a></li>
                        <li><a href="#services">HVAC Systems</a></li>
                        <li><a href="#services">Plumbing & Piping</a></li>
                        <li><a href="#services">Lift Installation</a></li>
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

    <!-- Add Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Slider Functionality
        const heroSlider = document.querySelector('.hero-slider');
        if (heroSlider) {
            const slides = heroSlider.querySelectorAll('.slide');
            const slideCount = slides.length;
            let currentSlide = 0;

            // Create navigation dots
            const navContainer = document.createElement('div');
            navContainer.className = 'slider-nav';
            heroSlider.appendChild(navContainer);

            slides.forEach((slide, index) => {
                const dot = document.createElement('button');
                dot.addEventListener('click', () => {
                    goToSlide(index);
                });
                navContainer.appendChild(dot);
            });

            const dots = navContainer.querySelectorAll('button');

            function goToSlide(index) {
                slides[currentSlide].classList.remove('active');
                dots[currentSlide].classList.remove('active');

                currentSlide = (index + slideCount) % slideCount;

                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }

            // Auto-advance slides
            let slideInterval = setInterval(() => {
                goToSlide(currentSlide + 1);
            }, 5000);

            // Initialize first slide
            goToSlide(0);

            // Pause on hover
            heroSlider.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });

            heroSlider.addEventListener('mouseleave', () => {
                slideInterval = setInterval(() => {
                    goToSlide(currentSlide + 1);
                }, 5000);
            });
        }

        // Initialize all other sliders on page
        const sliders = [{
                slider: document.querySelector('.category-slider'),
                prevBtn: document.querySelector('#categorySlider .slider-prev'),
                nextBtn: document.querySelector('#categorySlider .slider-next')
            },
            {
                slider: document.querySelector('.services-slider'),
                prevBtn: document.querySelector('.services-slider-section .slider-prev'),
                nextBtn: document.querySelector('.services-slider-section .slider-next')
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
                    '.services-slide') || slider.querySelector('.featured-slide');
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