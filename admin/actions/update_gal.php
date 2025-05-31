<?php
// Include the database configuration file
include '../config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $id = $_POST['id'];
    $department_assoc = mysqli_real_escape_string($conn, $_POST['department_assoc']);
    $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    // Handle file uploads (only if a new file is uploaded)
    $photo_one = isset($_FILES['photo_one']['name']) ? $_FILES['photo_one']['name'] : '';
    $photo_two = isset($_FILES['photo_two']['name']) ? $_FILES['photo_two']['name'] : '';
    $photo_three = isset($_FILES['photo_three']['name']) ? $_FILES['photo_three']['name'] : '';
    $photo_four = isset($_FILES['photo_four']['name']) ? $_FILES['photo_four']['name'] : '';

    $upload_dir = '../uploads/'; // Directory to store uploaded files

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Initialize paths for images
    $photo_one_path = '';
    $photo_two_path = '';
    $photo_three_path = '';
    $photo_four_path = '';

    // Move the uploaded files if any
    if ($photo_one) {
        $photo_one_path = $upload_dir . basename($photo_one);
        move_uploaded_file($_FILES['photo_one']['tmp_name'], $photo_one_path);
    }
    if ($photo_two) {
        $photo_two_path = $upload_dir . basename($photo_two);
        move_uploaded_file($_FILES['photo_two']['tmp_name'], $photo_two_path);
    }
    if ($photo_three) {
        $photo_three_path = $upload_dir . basename($photo_three);
        move_uploaded_file($_FILES['photo_three']['tmp_name'], $photo_three_path);
    }
    if ($photo_four) {
        $photo_four_path = $upload_dir . basename($photo_four);
        move_uploaded_file($_FILES['photo_four']['tmp_name'], $photo_four_path);
    }

    // Prepare the SQL update query
    $sql = "UPDATE gallery SET department_assoc = ?, event_title = ?, event_description = ?, venue = ?, date = ?, photo_one = ?, photo_two = ?, photo_three = ?, photo_four = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);

    // Check if the statement is prepared
    if ($stmt) {
        // Bind the parameters to the SQL query
        $stmt->bind_param('sssssssssi', $department_assoc, $event_title, $event_description, $venue, $date, $photo_one_path, $photo_two_path, $photo_three_path, $photo_four_path, $id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the gallery page with success message
            header("Location: gallery.php?success=updated");
            exit();
        } else {
            // Redirect to the gallery page with error message
            header("Location: gallery.php?error=update_failed");
            exit();
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Redirect with error message if the SQL preparation fails
        header("Location: gallery_page.php?error=sql_failed");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, redirect with error message
    header("Location: gallery.php?error=invalid_request");
    exit();
}
?>
