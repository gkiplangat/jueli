<?php
// Include the database configuration file
include 'config.php';

// SQL query to fetch data from the 'leaders' table
$sql = "SELECT id, product_picture, product_category, product_name, product_description FROM featured_products";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Extract variables from the row array
        $id = $row['id'];
        $product_picture = $row['product_picture'];
        $product_category = $row['product_category'];
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];

        echo "<tr>";
        echo "<td><img src='../uploads/" . htmlspecialchars($product_picture) . "' alt='Picture' class='img-thumbnail' width='50' height='50'></td>";
        echo "<td>" . htmlspecialchars($product_category) . "</td>";
        echo "<td>" . htmlspecialchars($product_name) . "</td>";
        echo "<td>" . htmlspecialchars($product_description) . "</td>";
        echo "<td>
                <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editFeatured" . $id . "'>Edit</button>
                <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteFeatured" . $id . "'>Delete</button>
              </td>";
        echo "</tr>";

        // Edit Modal
        echo "
        <div class='modal fade' id='editFeatured$id' tabindex='-1' aria-labelledby='editModalLabel$id' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title text-light' id='editModalLabel$id'>Edit Product</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='actions/edit_featured.php' method='POST' enctype='multipart/form-data'>
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
                                <input type='text' class='form-control' id='product_name$id' name='product_name' value='" . htmlspecialchars($product_name) . "' required>
                            </div>
                            
                            <!-- Product Description -->
                            <div class='mb-3'>
                                <label for='product_description$id' class='form-label'>Product Description</label>
                                <textarea class='form-control' id='product_description$id' name='product_description' rows='3' required>" . htmlspecialchars($product_description) . "</textarea>
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
        <div class='modal fade' id='deleteFeatured$id' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title text-white'>Delete Product</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>Are you sure you want to delete <strong>" . htmlspecialchars($product_name) . "</strong>?</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <a href='actions/delete_featured.php?id=$id' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No products found</td></tr>";
}

// Close the database connection
$conn->close();