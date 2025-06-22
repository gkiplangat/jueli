<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
?>

<!--HTML Code begins here-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jueli Engineering Ltd</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/logo_2.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/logo_2.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/logo_2.png">
    <link rel="manifest" href="../img/logo_2.png">
    <link rel="mask-icon" href="../img/logo_2.png" color="#003366">
    <meta name="msapplication-TileColor" content="#003366">
    <meta name="theme-color" content="#003366">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />

    <!-- Favicon -->
    <link rel="icon" href="img/sk_logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/sk_logo.png" type="image/x-icon" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">JUELI Ltd.</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex ms-auto">
                    <div class="input-group my-3 my-lg-0">
                        <input type="text" class="form-control" aria-label="Search" />
                        <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start text-white sidebar-nav" tabindex="-1" id="offcanvasExample">
        <br />
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li><a href="dashboard.php" class="nav-link px-3 active"><i
                                class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                    <li><a href="products.php" class="nav-link px-3 active"><i
                                class="bi bi-newspaper me-2"></i>Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link px-3 active dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-fill me-2"></i>Account
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item"><?php echo $_SESSION['username']; ?></a></li>
                            <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#resetPasswordModal">Reset Password</a></li>
                            <li><a href="logout.php" class="dropdown-item">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="resetPasswordForm" action="reset_password.php" method="POST">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                required>
                        </div>
                        <div class="text-danger">
                            <?php if (isset($_GET['error'])) {
                                echo $_GET['error'];
                            } ?>
                        </div>
                        <button type="submit" class="btn btn-secondary">Update Password</button>
                    </form>

                </div>
            </div>
        </div>
    </div>