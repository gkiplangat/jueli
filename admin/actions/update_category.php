<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $category = $conn->real_escape_string($_POST['category_name']);

    // Handle picture update
    if (!empty($_FILES['picture']['name'])) {
        $target_dir = "../../uploads/";
        $picture = basename($_FILES["picture"]["name"]);
        $target_file = $target_dir . $picture;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image file
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $valid_extensions)) {
            header("Location: dashboard.php?error=invalid_image&type=category");
            exit();
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            // Update query with new picture
            $sql = "UPDATE product_categories SET category_name='$category', picture='$picture' WHERE id=$id";
        } else {
            header("Location: dashboard.php?error=upload_failed&type=category");
            exit();
        }
    } else {
        // Update without changing the picture
        $sql = "UPDATE product_categories SET category_name='$category' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../dashboard.php?success=updated&type=categoryUpS");
        exit();
    } else {
        header("Location: ../dashboard.php?error=update_failed&type=categoryUpF");
        exit();
    }
}

$conn->close();