<?php
// Include the database configuration file
include '../config.php';

if (isset($_GET['id'])) {
    // Get the event ID from the URL
    $id = intval($_GET['id']);

    // Fetch the current photo to delete it from the uploads directory
    $sql = "SELECT photo FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($photo);

    // If event exists
    if ($stmt->fetch()) {
        // Delete the event from the database
        $deleteSql = "DELETE FROM events WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            // Delete the photo from the server if it exists
            if (!empty($photo) && file_exists("../../uploads/" . $photo)) {
                unlink("../uploads/" . $photo);
            }

            // Redirect with Success flag
            header("Location: ../news.php?success&type=NewsDelete");
            exit();
        } else {
            // Redirect with error message
            header("Location: ../news.php?message=Error deleting event");
        }

        $deleteStmt->close();
    } else {
        // Redirect with error flag
        header("Location: ../news.php?error&type=NewsDelete");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Invalid request, redirect with error message
    header("Location: ../news.php?message=Invalid request");
}

exit();