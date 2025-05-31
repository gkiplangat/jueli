<?php
// Include the database configuration file
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $category_id = $conn->real_escape_string($_POST['category_id']);
    $category_name = $conn->real_escape_string($_POST['category_name']);

    // Insert the data into the database
    $sql = "INSERT INTO categories (category_id, category_name) 
            VALUES ('$category_id', '$category_name')";

if ($conn->query($sql) === TRUE) {
    // Redirect with success flag
    header("Location: dashboard.php?success&type=category");
    exit();
} else {
    // Redirect with error flag
    header("Location: dashboard.php?error&type=category");
    exit();
}

    // Close the connection
    $conn->close();
}
?>
