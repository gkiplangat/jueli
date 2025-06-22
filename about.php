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

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    .navbar {
        background-color: #003366 !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
    }

    .navbar-brand span {
        color: #FFA500;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        padding: 0.5rem 1rem;
        margin: 0 0.1rem;
        transition: all 0.3s ease;
    }

    .nav-link:hover,
    .nav-link:focus {
        color: white !important;
        transform: translateY(-2px);
    }

    .nav-link.active {
        color: white !important;
        font-weight: 600;
        border-bottom: 2px solid #FFA500;
    }

    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .contact-btn {
        background-color: #FFA500;
        color: white !important;
        border-radius: 0.5rem;
        padding: 0.5rem 1.25rem !important;
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }

    .contact-btn:hover {
        opacity: 0.8;
    }

    /* Hero Section Styles */
    .hero-section {
        position: relative;
        height: 70vh;
        min-height: 500px;
        display: flex;
        align-items: center;
        background:
            linear-gradient(rgba(232, 119, 34, 0.5), rgba(232, 119, 34, 0.5)),
            url('img/bg_2.jpg') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 0 20px;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    .hero-section h1 {
        color: white;
        margin-bottom: 20px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .hero-section p {
        font-size: 1.5rem;
        color: black;
        margin: 0 auto 30px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 60vh;
            min-height: 400px;
        }

        .hero-section h1 {
            font-size: 2.2rem;
        }

        .hero-section p {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            height: 50vh;
            min-height: 350px;
        }

        .hero-section h1 {
            font-size: 1.8rem;
        }

        .hero-section p {
            font-size: 1rem;
        }
    }
    </style>
</head>

<body>

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
                            <a class="nav-link " href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="about.php">ABOUT US</a>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold">Quality Engineering Products</h1>
            <p class="lead">Premium engineering supplies and equipment for all your project needs</p>
        </div>
    </section>

    <!-- About Us -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Us</h2>
                    <p>Founded in December 2024, JUELI ENGINEERING LTD is based in Nairobi Industrial Area and offers a
                        broad spectrum of engineering services. Our company specializes in mechanical solutions, steel
                        fabrication, HVAC installations, plumbing, welding, lift services, and the supply of engineering
                        materials.</p>
                    <p>We pride ourselves on providing solutions that are efficient, reliable, and tailored to the
                        unique needs of each client. Our goal is to exceed client expectations while ensuring the
                        highest standards of safety, reliability, and performance in all our projects.</p>
                    <p>With a vision to be a premier provider of engineering services in Kenya and internationally, we
                        are committed to excellence in technical capabilities, customer service, and the delivery of
                        innovative solutions.</p>
                </div>
                <div class="about-image">
                    <img src="img/about_img.jpg" alt="JUELI Engineering Team">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section ">
        <div class="team-container">
            <h2 class="section-title">Our Expert Team</h2>

            <div class="team-row text-center">
                <?php
                // Include the database configuration
                require_once('admin/config.php');

                // Fetch team members from the database
                $query = "SELECT fullname, position, profile_picture FROM leaders";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Default image if profile picture is not available
                        $profile_pic = !empty($row['profile_picture']) ? 'uploads/' . $row['profile_picture'] : 'https://via.placeholder.com/150';
                ?>
                <div class="team-card">
                    <div class="team-img">
                        <img src="<?php echo htmlspecialchars($profile_pic); ?>"
                            alt="<?php echo htmlspecialchars($row['fullname']); ?>">
                    </div>
                    <div class="team-info">
                        <h3><?php echo htmlspecialchars($row['fullname']); ?></h3>
                        <p class="position"><?php echo htmlspecialchars($row['position']); ?></p>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<p>No team members found.</p>';
                }

                // Close the connection
                mysqli_close($conn);
                ?>
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
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>