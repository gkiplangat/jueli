<?php
// Include the database configuration file
include '../config.php';

// Check if the ID is set in the GET request
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the existing record to delete associated files
    $query = "SELECT photo_one, photo_two, photo_three, photo_four FROM gallery WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Delete files from the server
        foreach (['photo_one', 'photo_two', 'photo_three', 'photo_four'] as $photo) {
            if (!empty($row[$photo]) && file_exists("../uploads/" . $row[$photo])) {
                unlink("../uploads/" . $row[$photo]);
            }
        }

        // Delete the record from the database
        $deleteQuery = "DELETE FROM gallery WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $id);
        if ($deleteStmt->execute()) {
            // Redirect with Success flag
            header("Location: ../gallery.php?success&type=galleryDelete");
            exit();
        } else {
            // Redirect with error flag
            header("Location: ../gallery.php?error&type=galleryDelete");
            exit();
        }
    } else {
        header("Location: ../gallery.php?message=Record not found");
    }
} else {
    header("Location: ../gallery.php?message=Invalid request");
}

$conn->close();
?>