<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $name = $conn->real_escape_string($_POST['fullname']);
    $position = $conn->real_escape_string($_POST['position']);
    $phone = $conn->real_escape_string($_POST['phone_number']);

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "../uploads/"; // Folder to store images
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allow only certain file formats
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the server
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
                // Insert the data including image into the database
                $sql = "INSERT INTO leaders (fullname, position, phone_number, profile_picture) 
                        VALUES ('$name', '$position', '$phone', '$fileName')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: dashboard.php?success&type=leader");
                    exit();
                } else {
                    header("Location: dashboard.php?error&type=leader");
                    exit();
                }
            } else {
                header("Location: dashboard.php?upload_error&type=leader");
                exit();
            }
        } else {
            header("Location: dashboard.php?invalid_file&type=leader");
            exit();
        }
    } else {
        // If no image is uploaded, insert data without image
        $sql = "INSERT INTO leaders (fullname, position, phone_number) 
                VALUES ('$name', '$position', '$phone')";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php?success&type=leader");
            exit();
        } else {
            header("Location: dashboard.php?error&type=leader");
            exit();
        }
    }

    // Close the connection
    $conn->close();
}

?>