<?php
include '../partials/header.php';
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    // User is an admin and can access the role management page
} else {
    header("Location: ./index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];

    $userFilePath = "../users/" . $username . ".txt";

    if (file_exists($userFilePath)) {
        unlink($userFilePath);

        header("Location: index.php");
        exit();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    $username = $_GET['username'];
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Delete User: <?php echo $username; ?></h2>
        </div>
        <div class="card-body">
        
            <form method="POST">
                <h4 class="my-3">Are you sure you want to delete this user?</h4>
                <input type="hidden" name="username" value="<?php echo $username; ?>">
                
                <button class="btn btn-success" type="submit">Delete User</button>
                <a class="btn btn-danger" href="index.php" >Cancel</a>
            </form>
        </div>
    </div>

</div>
   
<?php include '../partials/footer.php'; ?>