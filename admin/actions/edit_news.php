<?php
// Include the database configuration file
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = intval($_POST['id']);
    $department = htmlspecialchars(trim($_POST['department_assoc']));
    $eventTitle = htmlspecialchars(trim($_POST['event_title']));
    $eventDescription = htmlspecialchars(trim($_POST['event_description']));
    $venue = htmlspecialchars(trim($_POST['venue']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['event_time']));

    // Handle the photo upload
    $uploadsDir = "../../uploads/";
    $uploadedPhoto = null;

    if (!empty($_FILES['photo']['name'])) {
        $fileName = time() . "_" . basename($_FILES['photo']['name']);
        $targetPath = $uploadsDir . $fileName;

        // Check if the file is uploaded successfully
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
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
            "UPDATE events SET department_assoc = ?, event_title = ?, event_description = ?, venue = ?, date = ?, event_time = ?, photo = ? WHERE id = ?"
        );
        $stmt->bind_param(
            "sssssssi",
            $department,
            $eventTitle,
            $eventDescription,
            $venue,
            $date,
            $time,
            $uploadedPhoto,
            $id
        );
    } else {
        // If no new photo was uploaded, do not update the photo field
        $stmt = $conn->prepare(
            "UPDATE events SET department_assoc = ?, event_title = ?, event_description = ?, venue = ?, date = ?, event_time = ? WHERE id = ?"
        );
        $stmt->bind_param(
            "ssssssi",
            $department,
            $eventTitle,
            $eventDescription,
            $venue,
            $date,
            $time,
            $id
        );
    }

    if ($stmt->execute()) {
        // Redirect with Success flag
        header("Location: ../news.php?success&type=NewsEdit");
        exit();
    } else {
        // Redirect with error flag
        header("Location: ../news.php?error&type=NewsEdit");
        exit();
    }

    // Closing the statement and connection
    $stmt->close();
    $conn->close();
    exit();
} else {
    // Invalid request
    header("Location: ../news.php?message=Invalid request");
    exit();
}