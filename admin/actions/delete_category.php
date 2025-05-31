<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get picture filename
    $query = "SELECT picture FROM product_categories WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $picture = $row['picture'];

        // Delete the image from the uploads folder
        $image_path = "../uploads/" . $picture;
        if (file_exists($image_path) && !empty($picture)) {
            unlink($image_path);
        }

        // Delete leader from database
        $sql = "DELETE FROM product_categories WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../dashboard.php?success=deleted&type=categoryDelS");
            exit();
        } else {
            header("Location: ../dashboard.php?error=delete_failed&type=categoryDelF");
            exit();
        }
    }
}

$conn->close();