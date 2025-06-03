<?php include 'includes/header.php' ?>

<!--Main Content-->
<main class="mt-5 pt-3">
    <!--Container to nest all other divisions-->
    <div class="container-fluid">


        <!--Leadership-->
        <div class="row mb-2 section-title">
            <div class="col-md-12 fw-bold fs-5">Jueli Engineering Team</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'leader'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        New leader added successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'leader'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to add the leader. Please try again.
                    </div>

                    <?php endif; ?>

                    <!--Delete Leader-->
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'leaderDelS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Deleted Successfuly!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'leaderDelF'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Delete. Please try again.
                    </div>

                    <?php endif; ?>

                    <!--Update Leader-->
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'leaderUpS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Updated Successfuly!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'leaderUpF'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Update. Please try again.
                    </div>

                    <?php endif; ?>


                    <!--reset-->

                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'resetPassS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Password reset successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'resetPassE'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to reset password. Please try again.
                    </div>

                    <?php endif; ?>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="table-title"><strong>Leaders Tables</strong></span>

                        <!-- Add Button to trigger the modal -->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#addleader">
                            Add New Leader
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>

                                        <th>Picture</th>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>Phone</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'get_leaders.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding New Leader -->
        <div class="modal fade" id="addleader" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="addItemModalLabel">
                            Add New Leader
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addItemForm" action="add_leader.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="fullname"
                                    placeholder="Enter Name" required />
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Enter Position" required />
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="phone" name="phone_number"
                                    placeholder="Enter Phone Number" required />
                            </div>
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                                    accept="image/*" required />
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary" id="saveItemButton">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!--======================
        Product Categories
        ==========================-->
        <!--Categories-->

        <div class="row mb-3">
            <div class="col-md-5">
                <div class="card">
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'category'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        New Category added successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'category'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to add the Category. Please try again.
                    </div>

                    <?php endif; ?>

                    <!--Delete Category-->
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'categoryDelS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Deleted Successfuly!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'categoryDelF'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Delete. Please try again.
                    </div>

                    <?php endif; ?>

                    <!--Update Category-->
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'categoryUpS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Updated Successfuly!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'catogoryUpF'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Update. Please try again.
                    </div>

                    <?php endif; ?>


                    <!--reset-->

                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'resetPassS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Password reset successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'resetPassE'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to reset password. Please try again.
                    </div>

                    <?php endif; ?>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="table-title"><strong>Product Categories</strong></span>

                        <!-- Add Button to trigger the modal -->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#addCategory">
                            Add New Category
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>

                                        <th>Picture</th>
                                        <th>Category Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'get_product_categories.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'category'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        New Category added successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'category'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to add the Category. Please try again.
                    </div>

                    <?php endif; ?>

                    <!--Delete Category-->
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'categoryDelS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Deleted Successfuly!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'categoryDelF'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Delete. Please try again.
                    </div>

                    <?php endif; ?>

                    <!--Update Category-->
                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'categoryUpS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Updated Successfuly!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'catogoryUpF'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Update. Please try again.
                    </div>

                    <?php endif; ?>


                    <!--reset-->

                    <!-- Check for success or error flags -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'resetPassS'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Password reset successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'resetPassE'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to reset password. Please try again.
                    </div>

                    <?php endif; ?>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="table-title"><strong>Featured Products</strong></span>

                        <!-- Add Button to trigger the modal -->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#addfeatured">
                            Add Featured Product
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>

                                        <th>Picture</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'get_featured_products.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding New Category -->
        <div class="modal fade" id="addfeatured" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light">
                        <h5 class="modal-title" id="addItemModalLabel">
                            Add New Product
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addItemForm" action="add_featured_products.php" method="POST"
                            enctype="multipart/form-data">
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