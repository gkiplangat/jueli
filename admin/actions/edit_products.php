<?php
// Include the database configuration file
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = intval($_POST['id']);
    $product_category = htmlspecialchars(trim($_POST['product_category']));
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $product_description = htmlspecialchars(trim($_POST['product_description']));

    // Handle the photo upload
    $uploadsDir = "../../uploads/";
    $uploadedPhoto = null;

    if (!empty($_FILES['product_picture']['name'])) {
        $fileName = time() . "_" . basename($_FILES['product_picture']['name']);
        $targetPath = $uploadsDir . $fileName;

        // Check if the file is uploaded successfully
        if (move_uploaded_file($_FILES['product_picture']['tmp_name'], $targetPath)) {
            $uploadedPhoto = $fileName;

            // Delete old photo if it exists
            if (!empty($_POST['current_photo']) && file_exists($uploadsDir . $_POST['current_photo'])) {
                unlink($uploadsDir . $_POST['current_photo']);
            }
        } else {
            // Handle upload error
            echo "Error uploading file.";
            exit();
        }
    } else {
        // Keep the existing photo
        $uploadedPhoto = $_POST['current_photo'] ?? null;
    }

    // **Modify the SQL Query to conditionally update the photo**
    if ($uploadedPhoto) {
        // If a new photo was uploaded, update it in the database
        $stmt = $conn->prepare(
            "UPDATE products SET product_category = ?, product_name = ?, product_description = ?, product_picture= ? WHERE id = ?"
        );
        $stmt->bind_param(
            "ssssi",
            $product_category,
            $product_name,
            $product_description,
            $uploadedPhoto,
            $id
        );
    } else {
        // If no new photo was uploaded, do not update the photo field
        $stmt = $conn->prepare(
            "UPDATE products SET product_category = ?, product_name = ?, product_description = ? WHERE id = ?"
        );
        $stmt->bind_param(
            "sssi",
            $department,
            $eventTitle,
            $eventDescription,
            $id
        );
    }

    if ($stmt->execute()) {
        // Redirect with Success flag
        header("Location: ../products.php?success&type=ProductEdit");
        exit();
    } else {
        // Redirect with error flag
        header("Location: ../products.php?error&type=ProductEdit");
        exit();
    }

    // Closing the statement and connection
    $stmt->close();
    $conn->close();
    exit();
} else {
    // Invalid request
    header("Location: ../products.php?message=Invalid request");
    exit();
}