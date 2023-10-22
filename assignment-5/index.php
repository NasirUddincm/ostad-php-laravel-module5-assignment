<?php include_once 'partials/header.php'; 

session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {

?>


    <div class="container mt-5">
        <h1 class="text-center">Welcome to Our Web Application</h1>
        <div class="text-center mt-4">
            <a href="./auth/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
<?php 

} else {
    // User is not logged in, redirect to the login page
    header("Location: auth/login.php");
    exit();
}

include_once 'partials/footer.php'; 

?>