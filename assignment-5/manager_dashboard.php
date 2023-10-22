<?php
include_once 'partials/header.php';
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] === 'manager') {
} else {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: user_dashboard.php");
    }
    exit();
}

?>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to Manager Dashboard/h1>
        <div class="text-center mt-4">
            <a href="./auth/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
<?php include_once 'partials/footer.php';  ?>