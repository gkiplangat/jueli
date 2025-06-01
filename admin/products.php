<!--Include Header Section -->
<?php include 'includes/header.php' ?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <!--Title-->
        <div class="row mb-2">
            <div class="col-md-12 fw-bold fs-5 section-title">
                Jueli Engineering Ltd
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'ProductEdit'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Updated successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'ProductEdit'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Update Record. Please try again.
                    </div>

                    <?php endif; ?>

                    <!-- Check for success or error flags for Deletion -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'ProductDelete'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Deleted Successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'ProductDelete'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Delete Record Please try again.
                    </div>

                    <?php endif; ?>

                    <!-- Check for success or error flags for Adding Records -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'ProductAdd'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Added Successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'ProductAdd'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Add Record Please try again.
                    </div>

                    <?php endif; ?>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="table-title"><strong>Products</strong></span>

                        <!-- Add Button to trigger the modal -->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#addProduct">
                            Add New Product
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Product Picture</th>
                                        <th>Product Category</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'get_products.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding New News -->
        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light">
                        <h5 class="modal-title" id="addItemModalLabel">
                            Add New Product
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addItemForm" action="add_product.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_category" class="form-label">Product Category</label>
                                <select class="form-control" id="product_category" name="product_category" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <?php
                                    // Include database configuration
                                    include 'config.php';

                                    // Fetch categories from the database
                                    $query = "SELECT category_name FROM product_categories";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        // Loop through each category and create an option
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($row['category_name']) . '">' . htmlspecialchars($row['category_name']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="" disabled>No category available</option>';
                                    }

                                    $conn->close();
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Enter Product Name" required />
                            </div>
                            <div class="mb-3">
                                <label for="product description" class="form-label">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description"
                                    placeholder="Enter Product Description" rows="4" required>
                                </textarea>
                            </div>


                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="picture" class="form-label">Product Picture</label>
                                        <input type="file" accept="image/*" class="form-control" id="product_picture"
                                            name="product_picture" required />
                                    </div>
                                </div>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <!-- Move this button inside the form and set its type to "submit" -->
                                <button type="submit" class="btn btn-primary" id="saveItemButton">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!--Include Footer Section-->
<?php include 'includes/footer.php' ?>