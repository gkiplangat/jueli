<?php
// Include database configuration file
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $department = mysqli_real_escape_string($conn, $_POST['department_assoc']);
    $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['event_time']);

    // Handle file uploads
    $photo = uniqid() . '_' . $_FILES['photo']['name'];
    $upload_dir = '../uploads/'; // Directory to store uploaded files

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Validate file type and size
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['photo']['type'], $allowed_types)) {
        echo "<script>alert('Invalid file type. Only JPG, PNG, and GIF are allowed.'); window.location.href = 'news.php';</script>";
        exit();
    }

    if ($_FILES['photo']['size'] > 5 * 1024 * 1024) { // Limit to 5MB
        echo "<script>alert('File size exceeds the limit of 5MB.'); window.location.href = 'news.php';</script>";
        exit();
    }

    // Move uploaded file
    $photo_path = $upload_dir . basename($photo);
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
        echo "<script>alert('Failed to upload the photo.'); window.location.href = 'news.php';</script>";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO events (department_assoc, event_title, event_description, venue, date, event_time, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssssss', $department, $event_title, $event_description, $venue, $date, $time, $photo);

        if ($stmt->execute()) {
            // Redirect with success flag
            header("Location: news.php?success&type=NewsAdd");
            exit();
        } else {
            // Redirect with error flag
            header("Location: news.php?error&type=NewsAdd");
            exit();
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: Could not prepare the database query.'); window.location.href = 'news.php';</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'gallery_page.php';</script>";
}