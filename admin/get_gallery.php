<?php 
// Include the database configuration file
include 'config.php';

// SQL query to fetch data from the 'gallery' table
$sql = "SELECT id, photo_one, photo_two, photo_three, photo_four FROM gallery"; 

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $photo_one = $row['photo_one'];
        $photo_two = $row['photo_two'];
        $photo_three = $row['photo_three'];
        $photo_four = $row['photo_four'];

        echo "<tr>";
        echo "<td><img src='../uploads/" . htmlspecialchars($photo_one) . "' alt='Photo 1' width='100' height='100'></td>";
        echo "<td><img src='../uploads/" . htmlspecialchars($photo_two) . "' alt='Photo 2' width='100' height='100'></td>";
        echo "<td><img src='../uploads/" . htmlspecialchars($photo_three) . "' alt='Photo 3' width='100' height='100'></td>";
        echo "<td><img src='../uploads/" . htmlspecialchars($photo_four) . "' alt='Photo 4' width='100' height='100'></td>";
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
                        <h5 class='modal-title text-light' id='editModalLabel$id'>Edit Gallery</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='actions/edit_gallery.php' method='POST' enctype='multipart/form-data'>
                            <input type='hidden' name='id' value='$id'>

                            <div class='mb-3'>
                                <label for='photoOne$id' class='form-label'>Photo 1</label>
                                <input type='file' class='form-control' id='photoOne$id' name='photo_one'>
                                <img src='../uploads/$photo_one' alt='Current Photo 1' width='100' height='100' class='mt-2'>
                            </div>

                            <div class='mb-3'>
                                <label for='photoTwo$id' class='form-label'>Photo 2</label>
                                <input type='file' class='form-control' id='photoTwo$id' name='photo_two'>
                                <img src='../uploads/$photo_two' alt='Current Photo 2' width='100' height='100' class='mt-2'>
                            </div>

                            <div class='mb-3'>
                                <label for='photoThree$id' class='form-label'>Photo 3</label>
                                <input type='file' class='form-control' id='photoThree$id' name='photo_three'>
                                <img src='../uploads/$photo_three' alt='Current Photo 3' width='100' height='100' class='mt-2'>
                            </div>

                            <div class='mb-3'>
                                <label for='photoFour$id' class='form-label'>Photo 4</label>
                                <input type='file' class='form-control' id='photoFour$id' name='photo_four'>
                                <img src='../uploads/$photo_four' alt='Current Photo 4' width='100' height='100' class='mt-2'>
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
                        Are you sure you want to delete the record for <strong>These Images</strong>?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <a href='actions/delete_gallery.php?id=$id' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No gallery data found</td></tr>";
}
$conn->close();
?>