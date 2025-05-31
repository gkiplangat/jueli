
<!--Include Header Section -->
<?php include 'includes/header.php' ?>

<main class="mt-5 pt-3">
	<div class="container-fluid">
		<!--Title-->
        <div class="row mb-2">
          <div class="col-md-12 fw-bold fs-3 section-title">
            What's Coming Up
          </div>  
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <div class="card">
              <!-- Check for success or error flags -->
              <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'NewsEdit'): ?>
              <div
              id="success-alert"
              class="alert alert-success alert-dismissible fade show"
              role="alert"
              >
              Record Updated successfully!
            </div>
            <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'NewsEdit'): ?>
            <div
            id="error-alert"
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
            >
            Failed to Update Record. Please try again.
          </div>
          
          <?php endif; ?>

          <!-- Check for success or error flags for Deletion -->
              <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'NewsDelete'): ?>
              <div
              id="success-alert"
              class="alert alert-success alert-dismissible fade show"
              role="alert"
              >
              Record Deleted Successfully!
            </div>
            <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'NewsDelete'): ?>
            <div
            id="error-alert"
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
            >
            Failed to Delete Record Please try again.
          </div>
          
          <?php endif; ?>

          <!-- Check for success or error flags for Adding Records -->
              <?php if (isset($_GET['success']) && isset($_GET['type']) && $_GET['type'] === 'NewsAdd'): ?>
              <div
              id="success-alert"
              class="alert alert-success alert-dismissible fade show"
              role="alert"
              >
              Record Added Successfully!
            </div>
            <?php elseif (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] === 'NewsAdd'): ?>
            <div
            id="error-alert"
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
            >
            Failed to Add Record Please try again.
          </div>
          
          <?php endif; ?>

      <div class="card-header d-flex justify-content-between align-items-center">
        <span class="table-title"><strong>Upcoming Events</strong></span>

        <!-- Add Button to trigger the modal -->
        <button
          class="btn btn-primary"
          type="button"
          data-bs-toggle="modal"
          data-bs-target="#addNews"
        >
          Add New
        </button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table
            id="example"
            class="table table-striped data-table"
            style="width: 100%"
          >
            <thead>
              <tr>
                <th>Department</th>
                <th>Event Title</th>
                <th>Event Description</th>
                <th>Venue</th>
                <th>Poster</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php include 'get_News.php'; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Modal for Adding New News -->
        <div
          class="modal fade"
          id="addNews"
          tabindex="-1"
          aria-labelledby="addItemModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-light">
                <h5 class="modal-title" id="addItemModalLabel">
                  Add New News
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <form id="addItemForm" action="add_News.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="department" class="form-label">Department Associated</label>
                    <select 
                        class="form-control"
                        id="department"
                        name="department_assoc"
                        required
                    >
                    <option value="" disabled selected>Select a department</option>
                      <?php
                    // Include database configuration
                    include 'config.php';

                    // Fetch departments from the database
                    $query = "SELECT department_name FROM departments";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                    // Loop through each department and create an option
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . htmlspecialchars($row['department_name']) . '">' . htmlspecialchars($row['department_name']) . '</option>';
                    }
                    } else {
                       echo '<option value="" disabled>No departments available</option>';
                    }

                   $conn->close();
                     ?>
                  </select>
              </div>

                  <div class="mb-3">
                    <label for="name" class="form-label">Event Title</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      name="event_title"
                      placeholder="Enter Event Title"
                      required
                    />
                  </div>
                  <div class="mb-3">
                    <label for="position" class="form-label">Event Description</label>
                    <textarea
                      class="form-control"
                      id="position"
                      name="event_description"
                      placeholder="Enter Event Description"
                      rows="4"
                      required>
                    </textarea>
                  </div>

                  <div class="mb-3">
                    <label for="phone" class="form-label">Venue</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      name="venue"
                      placeholder="Where will the event Happen? "
                      required
                    />
                  </div>

                  <div class="mb-3">
                    <label for="phone" class="form-label">Date</label>
                    <input
                      type="date"
                      class="form-control"
                      id="phone"
                      name="date"
                      required
                    />
                  </div>

                  <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input
                      type="time"
                      class="form-control"
                      id="time"
                      name="event_time"
                      required
                    />
                  </div>


                  <div class="mb-3">
                    <div class="row" >
                    	<div class="col-md-12">
                    		<label for="phone" class="form-label">Poster</label>
                    		<input type="file" accept="image/*" 
                    		class="form-control" 
                    		id="photo" 
                    		name="photo"
                    		required/>
                    	</div>
                    </div>
                  </div>

                   

                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      Close
                    </button>
                    <!-- Move this button inside the form and set its type to "submit" -->
                    <button
                      type="submit"
                      class="btn btn-primary"
                      id="saveItemButton"
                    >
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