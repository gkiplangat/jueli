<?php
session_start();
require 'config.php'; // Ensure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $currentPassword = md5($_POST['currentPassword']); // Hash input password using MD5
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        header("Location: dashboard.php?error=Passwords do not match");
        exit();
    }

    $username = $_SESSION['username']; // Assuming the username is stored in the session

    // Fetch the current MD5-hashed password from the database
    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();

    // Verify the current password
    if ($currentPassword !== $storedPassword) { // Compare hashed input with stored MD5 hash
        header("Location: dashboard.php?error=Incorrect current password");
        exit();
    }

    // Hash the new password with MD5
    $hashedNewPassword = md5($newPassword);

    // Update the password in the database
    $updateQuery = "UPDATE users SET password = ? WHERE username = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ss", $hashedNewPassword, $username);

    if ($updateStmt->execute()) {
        header("Location: dashboard.php?success&type=resetPassS");
    } else {
        header("Location: dashboard.php?error&type=resetPassE");
    }
}
?>
