<?php
// Include the database configuration file
include 'config.php';

// SQL query to fetch data from the 'categories' table
$sql = "SELECT category_id, category_name FROM categories ORDER BY category_id ASC";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
        echo "</tr>";
    }
} else {
    // If no data is found
    echo "<tr><td colspan='4' class='text-center'>No Categories Found</td></tr>";
}

// Close the database connection
$conn->close();
?>
