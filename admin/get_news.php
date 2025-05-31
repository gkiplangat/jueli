<?php
// Include the database configuration file
include 'config.php';

// SQL query to fetch data from the 'events' table
$sql = "SELECT id, department_assoc, event_title, event_description, venue, date, event_time, photo FROM events";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $department = htmlspecialchars($row['department_assoc']);
        $title = htmlspecialchars($row['event_title']);
        $description = htmlspecialchars($row['event_description']);
        $venue = htmlspecialchars($row['venue']);
        $date = htmlspecialchars($row['date']);
        $time = htmlspecialchars($row['event_time']);

        $photo = htmlspecialchars($row['photo']);

        echo "<tr>";
        echo "<td>$department</td>";
        echo "<td>$title</td>";
        echo "<td>$description</td>";
        echo "<td>$venue</td>";
        echo "<td>$date</td>";
        echo "<td><img src='../uploads/$photo' alt='Photo' width='100' height='100'></td>";
        echo "<td>
                <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal$id'>Edit</button>
                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal$id'>Delete</button>
              </td>";
        echo "</tr>";

        // Edit Modal
        echo "
        <div class='modal fade' id='editModal$id' tabindex='-1' aria-labelledby='editModalLabel$id' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title text-light' id='editModalLabel$id'>Edit News</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='actions/edit_news.php' method='POST' enctype='multipart/form-data'>
                            <!-- Hidden input for ID -->
                            <input type='hidden' name='id' value='$id'>
                            
                            <!-- Department -->
                            <div class='mb-3'>
                                <label for='department$id' class='form-label'>Department</label>
                                <input type='text' class='form-control' id='department$id' name='department_assoc' value='$department' required>
                            </div>
                            
                            <!-- Event Title -->
                            <div class='mb-3'>
                                <label for='title$id' class='form-label'>Event Title</label>
                                <input type='text' class='form-control' id='title$id' name='event_title' value='$title' required>
                            </div>
                            
                            <!-- Event Description -->
                            <div class='mb-3'>
                                <label for='description$id' class='form-label'>Event Description</label>
                                <textarea class='form-control' id='description$id' name='event_description' rows='3' required>$description</textarea>
                            </div>
                            
                            <!-- Venue -->
                            <div class='mb-3'>
                                <label for='venue$id' class='form-label'>Venue</label>
                                <input type='text' class='form-control' id='venue$id' name='venue' value='$venue' required>
                            </div>
                            
                            <!-- Date -->
                            <div class='mb-3'>
                                <label for='date$id' class='form-label'>Date</label>
                                <input type='date' class='form-control' id='date$id' name='date' value='$date' required>
                            </div>

                             <!-- Date -->
                            <div class='mb-3'>
                                <label for='event_time$id' class='form-label'>Time</label>
                                <input type='time' class='form-control' id='date$id' name='event_time' value='$time' required>
                            </div>
                            
                            <!-- Photo -->
                            <div class='mb-3'>
                                <label for='photo$id' class='form-label'>Photo</label>
                                <input type='file' class='form-control' id='photo$id' name='photo'>
                                <img src='../uploads/$photo' alt='Current Photo' width='100' height='100' class='mt-2'>
                            </div>
                            
                            <button type='submit' class='btn btn-primary'>Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

        // Delete Modal
        echo "
        <div class='modal fade' id='deleteModal$id' tabindex='-1' aria-labelledby='deleteModalLabel$id' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title text-light' id='deleteModalLabel$id'>Confirm Delete</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        Are you sure you want to delete the event <strong>$title</strong>?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <a href='actions/delete_news.php?id=$id' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>No events data found</td></tr>";
}

// Close the database connection
$conn->close();