<?php
include_once '../partials/header.php';
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    // User is an admin and can access the role management page
} else {
    header("Location: ../index.php");
    exit();
}
$userList = [];

foreach (glob('../users/*.txt') as $filename) {
    $userData = file_get_contents($filename);
    $userList[] = $userData;
}
?>
<div class="container mt-5">
    
    <div class="card">
       
        <div class="card-header row mx-0">
            <div class="col-auto">
                <h3>User & Role Management</h3>
            </div>
            <div class="col-auto ms-auto">
                <a href="../admin_dashboard.php" class="btn btn-success">Home</a>
            </div>
        </div>
        <div class="card-body">
            <a href="create.php" class="btn btn-success">Add New</a>
        <table class="table table-bordered">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($userList as $userData) : ?>
            <?php $user_info = explode("\n", $userData); ?>
            <tr>
                <td><?php echo trim(explode(":", $user_info[0])[1]); ?></td>
                <td><?php echo trim(explode(":", $user_info[1])[1]); ?></td>
                <td><?php echo trim(explode(":", $user_info[3])[1]); ?></td>
                <td>
                    <!-- Add edit and delete links here -->
                    <a  class="btn btn-primary"
                        href="edit.php?username=<?php echo urlencode(trim(explode(":", $user_info[0])[1])); ?>">
                        Edit
                    </a>
                    <a  class="btn btn-danger"
                        href="delete.php?username=<?php echo urlencode(trim(explode(":", $user_info[0])[1])); ?>">
                        Delete
                    </a>                    

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
        </div>
    </div>
    
</div>
   <?php include_once '../partials/footer.php' ?>
