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
    <title>JUELI ENGINEERING LTD - Engineering Solutions for a Sustainable Future</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header and Hero Slider sections remain unchanged -->

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
                                            $imagePath = 'img/categories/' . $imagePath;
                                        }
                                    ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>"
                                alt="<?php echo htmlspecialchars($category['category_name']); ?>">
                            <?php else: ?>
                            <img src="img/categories/default.jpg"
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

    <!-- Rest of your existing code -->
    <!-- Featured Products -->
    <section class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-img">
                    <img src="img/products/bolts.jpg">
                </div>
                <div class="product-info">
                    <h3>Anchor bolts and rawl bolts</h3>
                    <p>Anchor bolts are used to securely attach structural elements to concrete foundations.</p>
                    <div class="price-contact">
                        <a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING,%20I'm%20interested%20in%20your%20Anchor%20bolts%20and%20rawl%20bolts%20product.%20Could%20you%20please%20share%20the%20price%20and%20details?"
                            class="whatsapp-btn" style="background:#003366;" target="_blank">
                            <i class="fab fa-whatsapp"></i> Contact for Price
                        </a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img">
                    <img src="img/products/roofing_screws.jpg" alt="Steel Beams">
                </div>
                <div class="product-info">
                    <h3>Roofing screws</h3>
                    <p>Specialized fasteners with rubber washers used to securely attach metal roofing sheets or panels
                        to structures while preventing water leaks.</p>
                    <div class="price-contact">
                        <a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING,%20I'm%20interested%20in%20your%20Roofing%20screws%20product.%20Could%20you%20please%20share%20the%20price%20and%20details?"
                            class="whatsapp-btn" style="background:#003366;" target="_blank">
                            <i class="fab fa-whatsapp"></i> Contact for Price
                        </a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img">
                    <img src="img/products/cutting_disk.png" alt="Elevator System">
                </div>
                <div class="product-info">
                    <h3>Cutting discs and grinding discs</h3>
                    <p>Used for precise slicing through metal, concrete, or stone.</p>
                    <div class="price-contact">
                        <a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING,%20I'm%20interested%20in%20your%20Cutting%20discs%20and%20grinding%20discs%20product.%20Could%20you%20please%20share%20the%20price%20and%20details?"
                            class="whatsapp-btn" style="background:#003366;" target=" _blank">
                            <i class="fab fa-whatsapp"></i> </i> Contact for Price
                        </a>
                    </div>
                </div>
            </div>

            <div class=" product-card">
                <div class="product-img">
                    <img src="img/products/plumbing_accessories.jpg">
                </div>
                <div class="product-info">
                    <h3>Plumbing accessories</h3>
                    <p>Enhance, regulate, or maintain the efficiency and functionality of plumbing
                        systems.</p>
                    <div class="price-contact">
                        <a href="https://wa.me/254704553400?text=Hello%20JUELI%20ENGINEERING,%20I'm%20interested%20in%20your%20Plumbing%20accessories%20product.%20Could%20you%20please%20share%20the%20price%20and%20details?"
                            class="whatsapp-btn" style="background:#003366;" target="_blank">
                            <i class="fab fa-whatsapp"></i> Contact for Price
                        </a>
                    </div>
                </div>
            </div>
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
                        <p>Design, installation, and ongoing maintenance of mechanical systems for various applications.
                        </p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="service-info">
                        <h3>Steel Structure Design & Fabrication</h3>
                        <p>Providing top-quality steel structures tailored for residential, commercial, and industrial
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
                        <p>Comprehensive installation and maintenance of plumbing and piping systems for water, gas, and
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
                        <p>Complete lift design, installation, and maintenance for residential and commercial buildings.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Partners -->
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
    </script>
</body>

</html>