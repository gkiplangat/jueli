<!--Include Header Section -->
<?php include 'includes/header.php' ?>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <!--Title-->
        <div class="row mb-2">
            <div class="col-md-12 fw-bold fs-3 section-title">
                Our Gallery
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <!-- Check for success or error flags for Add -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'galleryAdd'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Added successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'galleryAdd'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Add Record. Please try again.
                    </div>

                    <?php endif; ?>

                    <!-- Check for success or error flags for Edit -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'galleryUpdate'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Updated successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'galleryUpdate'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Update Record. Please try again.
                    </div>

                    <?php endif; ?>

                    <!-- Check for success or error flags for Delete -->
                    <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'galleryDelete'): ?>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                        Record Deleted successfully!
                    </div>
                    <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'galleryDelete'): ?>
                    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to Update Delete. Please try again.
                    </div>

                    <?php endif; ?>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="table-title"><strong>Images</strong></span>

                        <!-- Add Button to trigger the modal -->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#addgallery">
                            Add New
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>

                                        <th>Photo 1</th>
                                        <th>Photo 2</th>
                                        <th>Photo 3</th>
                                        <th>Photo 4</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'get_gallery.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding New Gallery -->
        <div class="modal fade" id="addgallery" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light">
                        <h5 class="modal-title" id="addItemModalLabel">
                            Add New Gallery
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addItemForm" action="add_gallery.php" method="POST" enctype="multipart/form-data">


                            <div class="mb-3">
                                <div class="row">

                                    <label for="phone" class="form-label">Photo_One</label>
                                    <input type="file" accept="image/*" class="form-control" id="phone_one"
                                        name="photo_one" required />
                                </div>

                                <div class="row">
                                    <label for="phone" class="form-label">Photo_Two</label>
                                    <input type="file" accept="image/*" class="form-control" id="phone_three"
                                        name="photo_two" required />
                                </div>

                                <div class="row">
                                    <label for="phone" class="form-label">Photo_Three</label>
                                    <input type="file" accept="image/*" class="form-control" id="phone_three"
                                        name="photo_three" required />
                                </div>

                                <div class="row">
                                    <label for="phone" class="form-label">Photo_Four</label>
                                    <input type="file" accept="image/*" class="form-control" id="phone_four"
                                        name="photo_four" required />
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