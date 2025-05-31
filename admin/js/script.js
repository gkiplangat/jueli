// Auto-dismiss success alert after 5 seconds
//Leaders
setTimeout(() => {
  const successAlert = document.getElementById('success-alert');
  const errorAlert = document.getElementById('error-alert');
  if (successAlert) {
    successAlert.classList.remove('show');
    successAlert.classList.add('fade');
  }
  if (errorAlert) {
    errorAlert.classList.remove('show');
    errorAlert.classList.add('fade');
  }
}, 5000);

//Categories
setTimeout(() => {
  const successAlert = document.getElementById('success-alert');
  const errorAlert = document.getElementById('error-alert');
  if (successAlert) {
    successAlert.classList.remove('show');
    successAlert.classList.add('fade');
  }
  if (errorAlert) {
    errorAlert.classList.remove('show');
    errorAlert.classList.add('fade');
  }
}, 5000);

//Departments
setTimeout(() => {
  const successAlert = document.getElementById('success-alert');
  const errorAlert = document.getElementById('error-alert');
  if (successAlert) {
    successAlert.classList.remove('show');
    successAlert.classList.add('fade');
  }
  if (errorAlert) {
    errorAlert.classList.remove('show');
    errorAlert.classList.add('fade');
  }
}, 5000);

document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded!"); // Debugging

    // Ensure Bootstrap Modal is available
    if (typeof bootstrap === 'undefined') {
        console.error("Bootstrap JS is not loaded!");
        return;
    }

    // Get Reset Password button and modal
    const resetPasswordBtn = document.getElementById("resetPasswordBtn");
    const resetPasswordModalEl = document.getElementById("resetPasswordModal");

    if (!resetPasswordBtn || !resetPasswordModalEl) {
        console.error("Reset Password button or modal is missing!");
        return;
    }

    const resetPasswordModal = new bootstrap.Modal(resetPasswordModalEl);

    // Open modal when Reset Password button is clicked
    resetPasswordBtn.addEventListener("click", function (event) {
        event.preventDefault();
        console.log("Reset Password button clicked");
        resetPasswordModal.show();
    });

    // Handle form submission
    document.getElementById("resetPasswordForm").addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("Reset Password form submitted");

        let currentPassword = document.getElementById("currentPassword").value;
        let newPassword = document.getElementById("newPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;

        if (newPassword !== confirmPassword) {
            alert("New passwords do not match!");
            return;
        }

        // Send data to PHP file
        fetch("reset_password.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                currentPassword: currentPassword,
                newPassword: newPassword
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response received:", data);
            if (data.success) {
                alert("Password reset successful!");
                resetPasswordModal.hide();
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(error => console.error("Fetch error:", error));
    });
});
