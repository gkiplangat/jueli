<?php
// Include database configuration file
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);

    // Handle file uploads
    $product_picture = uniqid() . '_' . $_FILES['product_picture']['name'];
    $upload_dir = '../uploads/'; // Directory to store uploaded files

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Validate file type and size
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['product_picture']['type'], $allowed_types)) {
        echo "<script>alert('Invalid file type. Only JPG, PNG, and GIF are allowed.'); window.location.href = 'news.php';</script>";
        exit();
    }

    if ($_FILES['product_picture']['size'] > 5 * 1024 * 1024) { // Limit to 5MB
        echo "<script>alert('File size exceeds the limit of 5MB.'); window.location.href = 'news.php';</script>";
        exit();
    }

    // Move uploaded file
    $photo_path = $upload_dir . basename($product_picture);
    if (!move_uploaded_file($_FILES['product_picture']['tmp_name'], $photo_path)) {
        echo "<script>alert('Failed to upload the photo.'); window.location.href = 'products.php';</script>";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO featured_products (product_category, product_name, product_description,  product_picture) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ssss', $product_category, $product_name, $product_description, $product_picture);

        if ($stmt->execute()) {
            // Redirect with success flag
            header("Location: dashboard.php?success&type=featuredS");
            exit();
        } else {
            // Redirect with error flag
            header("Location: dashboard.php?error&type=featuredF");
            exit();
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: Could not prepare the database query.'); window.location.href = 'dashboard.php';</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'dashboard.php';</script>";
}