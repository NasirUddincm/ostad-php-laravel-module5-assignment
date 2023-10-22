<?php
require_once 'partials/header.php';
session_start();
if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    // Display the content for the 'user' role
} else {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($_SESSION['role'] === 'manager') {
        header("Location: manager_dashboard.php");
    }elseif ($_SESSION['role'] === 'user') {
        header("Location: user_dashboard.php");
    }
}

?>
<div class="container mt-5">
    <h1 class="text-center">Welcome to Admin Dashboard</h1>
    <div class="text-center mt-4">        
        <a href="userRole/index.php" class="btn btn-success">User & Role Management</a>
        <a href="./auth/logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<?php include_once 'partials/footer.php';  ?>