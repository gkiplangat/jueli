<?php
// Include the database configuration file
include '../config.php';

if (isset($_GET['id'])) {
    // Get the product ID from the URL
    $id = intval($_GET['id']);

    // Fetch the current photo to delete it from the uploads directory
    $sql = "SELECT product_picture FROM featured_products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($product_picture);

    // If event exists
    if ($stmt->fetch()) {
        // Delete the product from the database
        $deleteSql = "DELETE FROM featured_products WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            // Delete the product picture from the server if it exists
            if (!empty($photo) && file_exists("../../uploads/" . $photo)) {
                unlink("../uploads/" . $photo);
            }

            // Redirect with Success flag
            header("Location: ../dashboard.php?success&type=featured_categoryDelS");
            exit();
        } else {
            // Redirect with error message
            header("Location: ../dashboard.php?message=Error deleting Product");
        }

        $deleteStmt->close();
    } else {
        // Redirect with error flag
        header("Location: ../dashboard.php?error&type=featured_categoryDelF");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Invalid request, redirect with error message
    header("Location: ../dashboard.php?message=Invalid request");
}

exit();