<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get profile picture filename
    $query = "SELECT profile_picture FROM leaders WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profile_picture = $row['profile_picture'];

        // Delete the image from the uploads folder
        $image_path = "../uploads/" . $profile_picture;
        if (file_exists($image_path) && !empty($profile_picture)) {
            unlink($image_path);
        }

        // Delete leader from database
        $sql = "DELETE FROM leaders WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../dashboard.php?success=deleted&type=leaderDelS");
            exit();
        } else {
            header("Location: ../dashboard.php?error=delete_failed&type=leaderDelF");
            exit();
        }
    }
}

$conn->close();