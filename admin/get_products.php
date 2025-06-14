<?php
include 'config.php';

// Get current page from URL or default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Get category filter if set
$category_filter = isset($_GET['category_filter']) ? $_GET['category_filter'] : '';

// Base SQL query
$sql = "SELECT * FROM products";

// Add WHERE clause if category filter is set
if (!empty($category_filter)) {
    $sql .= " WHERE product_category = '" . $conn->real_escape_string($category_filter) . "'";
}

// Add pagination
$sql .= " LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='../uploads/" . htmlspecialchars($row['product_picture']) . "' alt='Product' class='img-thumbnail' width='50' height='50'></td>";
        echo "<td>" . htmlspecialchars($row['product_category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
        echo "<td>" . htmlspecialchars(substr($row['product_description'], 0, 50)) . "...</td>";
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
                        <h5 class='modal-title text-white'>Edit Product</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form action='actions/update_product.php' method='POST' enctype='multipart/form-data'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <div class='mb-3'>
                                <label class='form-label'>Product Picture</label>
                                <input type='file' class='form-control' name='product_picture' accept='image/*'>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Product Category</label>
                                <input type='text' class='form-control' name='product_category' value='" . htmlspecialchars($row['product_category']) . "' required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Product Name</label>
                                <input type='text' class='form-control' name='product_name' value='" . htmlspecialchars($row['product_name']) . "' required>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Product Description</label>
                                <textarea class='form-control' name='product_description' required>" . htmlspecialchars($row['product_description']) . "</textarea>
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
                        <h5 class='modal-title text-white'>Delete Product</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p>Are you sure you want to delete <strong>" . htmlspecialchars($row['product_name']) . "</strong>?</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <a href='actions/delete_product.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No products found</td></tr>";
}

$conn->close();