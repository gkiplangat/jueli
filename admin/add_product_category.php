<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $category = $conn->real_escape_string($_POST['category_name']);
   

    // Handle file upload
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $targetDir = "../uploads/"; // Folder to store images
        $fileName = basename($_FILES["picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allow only certain file formats
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the server
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
                // Insert the data including image into the database
                $sql = "INSERT INTO product_categories (category_name, picture) 
                        VALUES ('$category', '$fileName')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: dashboard.php?success&type=category");
                    exit();
                } else {
                    header("Location: dashboard.php?error&type=category");
                    exit();
                }
            } else {
                header("Location: dashboard.php?upload_error&type=category");
                exit();
            }
        } else {
            header("Location: dashboard.php?invalid_file&type=category");
            exit();
        }
    } else {
        // If no image is uploaded, insert data without image
        $sql = "INSERT INTO product_categories (category_name) 
                VALUES ('$category')";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php?success&type=category");
            exit();
        } else {
            header("Location: dashboard.php?error&type=category");
            exit();
        }
    }

    // Close the connection
    $conn->close();
}

?>