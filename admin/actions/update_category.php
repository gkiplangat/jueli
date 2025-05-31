<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $position = $conn->real_escape_string($_POST['position']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);

    // Handle profile picture update
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "../../uploads/";
        $profile_picture = basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . $profile_picture;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image file
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $valid_extensions)) {
            header("Location: dashboard.php?error=invalid_image&type=leader");
            exit();
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Update query with new profile picture
            $sql = "UPDATE leaders SET fullname='$fullname', position='$position', phone_number='$phone_number', profile_picture='$profile_picture' WHERE id=$id";
        } else {
            header("Location: dashboard.php?error=upload_failed&type=leader");
            exit();
        }
    } else {
        // Update without changing the profile picture
        $sql = "UPDATE leaders SET fullname='$fullname', position='$position', phone_number='$phone_number' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../dashboard.php?success=updated&type=leaderUpS");
        exit();
    } else {
        header("Location: ../dashboard.php?error=update_failed&type=leaderUpF");
        exit();
    }
}

$conn->close();