<?php
// Include the database configuration file
include 'config.php';

// SQL query to fetch data from the 'events' table
$sql = "SELECT id, product_category, product_name, product_description, product_picture FROM products";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $product_category = htmlspecialchars($row['product_category']);
        $product_name = htmlspecialchars($row['product_name']);
        $product_description = htmlspecialchars($row['product_description']);
        

        $product_picture = htmlspecialchars($row['product_picture']);

        echo "<tr>";
        echo "<td><img src='../uploads/$product_picture' alt='Product Picture' width='100' height='100'></td>";
        echo "<td>$product_category</td>";
        echo "<td>$product_name</td>";
        echo "<td>$product_description</td>";
        
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
                        <h5 class='modal-title text-light' id='editModalLabel$id'>Edit Product</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='actions/edit_products.php' method='POST' enctype='multipart/form-data'>
                            <!-- Hidden input for ID -->
                            <input type='hidden' name='id' value='$id'>
                            
                            <!-- Product Category -->
                            <div class='mb-3'>
                                <label for='product_category$id' class='form-label'>Product_category</label>
                                <input type='text' class='form-control' id='product_categoryc$id' name='product_category' value='$product_category' required>
                            </div>
                            
                            <!-- Product Name -->
                            <div class='mb-3'>
                                <label for='product_name$id' class='form-label'>Product Name</label>
                                <input type='text' class='form-control' id='product_name$id' name='product_name' value='$product_name' required>
                            </div>
                            
                            <!-- Product Description -->
                            <div class='mb-3'>
                                <label for='product_description$id' class='form-label'>Product Description</label>
                                <textarea class='form-control' id='product_description$id' name='product_description' rows='3' required>$product_description</textarea>
                            </div>
                            
                            <!-- Product Picture -->
                            <div class='mb-3'>
                                <label for='product_picture$id' class='form-label'>Product Picture</label>
                                <input type='file' class='form-control' id='product_picture$id' name='product_picture'>
                                <img src='../uploads/$product_picture' alt='Current Photo' width='100' height='100' class='mt-2'>
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
                        Are you sure you want to delete the event <strong>$product_name</strong>?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <a href='actions/delete_products.php?id=$id' class='btn btn-danger'>Delete</a>
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