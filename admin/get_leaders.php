<?php
// Include the database configuration file
include 'config.php';

// SQL query to fetch data from the 'leaders' table
$sql = "SELECT id, fullname, position, phone_number, profile_picture FROM leaders";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='../uploads/" . htmlspecialchars($row['profile_picture']) . "' alt='Profile Picture' class='img-thumbnail' width='50' height='50'></td>";
        echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['position']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
        echo "<td>
                <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Edit</button>
                <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row['id'] . "'>Delete</button>
              </td>";
        echo "</tr>";

        // Edit Modal
        echo "
        <div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title text-white'>Edit Leader</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='actions/update_leader.php' method='POST' enctype='multipart/form-data'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <div class='mb-3'>
                                <label class='form-label'>Name</label>
                                <input type='text' class='form-control' name='fullname' value='" . htmlspecialchars($row['fullname']) . "' required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Position</label>
                                <input type='text' class='form-control' name='position' value='" . htmlspecialchars($row['position']) . "' required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Phone Number</label>
                                <input type='number' class='form-control' name='phone_number' value='" . htmlspecialchars($row['phone_number']) . "' required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Profile Picture</label>
                                <input type='file' class='form-control' name='profile_picture' accept='image/*'>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                <button type='submit' class='btn btn-primary'>Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

        // Delete Modal
        echo "
        <div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title text-white'>Delete Leader</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>Are you sure you want to delete <strong>" . htmlspecialchars($row['fullname']) . "</strong>?</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <a href='actions/delete_leader.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No leaders found</td></tr>";
}

// Close the database connection
$conn->close();