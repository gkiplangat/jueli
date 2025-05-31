<?php
// Include the database configuration file
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $department_id = $conn->real_escape_string($_POST['department_id']);
    $department_name = $conn->real_escape_string($_POST['department_name']);
    $year = $conn->real_escape_string($_POST['year']);

    // Insert the data into the database
    $sql = "INSERT INTO departments (department_id, department_name, year) 
            VALUES ('$department_id', '$department_name', '$year')";

if ($conn->query($sql) === TRUE) {
    // Redirect with success flag
    header("Location: dashboard.php?success&type=department");
    exit();
} else {
    // Redirect with error flag
    header("Location: dashboard.php?error&type=department");
    exit();
}

    // Close the connection
    $conn->close();
}
?>
