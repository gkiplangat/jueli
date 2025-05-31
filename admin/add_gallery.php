<?php
// Include database configuration file
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $department = mysqli_real_escape_string($conn, $_POST['department_assoc']);
    // Handle file uploads
    $photo_one = $_FILES['photo_one']['name'];
    $photo_two = $_FILES['photo_two']['name'];
    $photo_three = $_FILES['photo_three']['name'];
    $photo_four = $_FILES['photo_four']['name'];

    $upload_dir = '../uploads/'; // Directory to store uploaded files

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Move uploaded files to the upload directory
    $photo_one_path = $upload_dir . basename($photo_one);
    $photo_two_path = $upload_dir . basename($photo_two);
    $photo_three_path = $upload_dir . basename($photo_three);
    $photo_four_path = $upload_dir . basename($photo_four);

    move_uploaded_file($_FILES['photo_one']['tmp_name'], $photo_one_path);
    move_uploaded_file($_FILES['photo_two']['tmp_name'], $photo_two_path);
    move_uploaded_file($_FILES['photo_three']['tmp_name'], $photo_three_path);
    move_uploaded_file($_FILES['photo_four']['tmp_name'], $photo_four_path);

    // Insert data into the database
    $sql = "INSERT INTO gallery (department_assoc,photo_one, photo_two, photo_three, photo_four) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssss', $department, $photo_one, $photo_two, $photo_three, $photo_four);

        if ($stmt->execute()) {
            // Redirect with Success flag
            header("Location: gallery.php?success&type=galleryAdd");
            exit();
        } else {
            // Redirect with error flag
            header("Location: gallery.php?error&type=galleryAdd");
            exit();
        }
        

        $stmt->close();
    } else {
        echo "<script>alert('Error: Could not prepare the database query.'); window.location.href = 'gallery_page.php';</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'gallery.php';</script>";
}
?>
