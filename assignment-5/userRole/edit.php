<?php
include_once '../partials/header.php';
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    // User is an admin and can access the role management page
} else {
    header("Location: ./index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $userFilePath = "../users/".$username.".txt";
    
    if (file_exists($userFilePath)) {
        $user_data = file_get_contents($userFilePath);
        $user_info = explode("\n", $user_data);
        
        $user_info[1] = "Email: " . $email;
        $user_info[3] = "Role: " . $role;
        
        file_put_contents($userFilePath, implode("\n", $user_info));
        
        header("Location: index.php");
        exit();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    $username = $_GET['username'];

    $userFilePath = "../users/" . $username . ".txt";
    if (file_exists($userFilePath)) {
        $user_data = file_get_contents($userFilePath);
        $user_info = explode("\n", $user_data);

        $email = trim(explode(":", $user_info[1])[1]);
        $role = trim(explode(":", $user_info[3])[1]);
    } else {
        echo "User not found.";
        exit();
    }
}
?>

    <div class="container mt-5">       
        
        <div class="card">
            <div class="card-header row mx-0">
                <div class="col-auto">
                    <h3>Edit User</h3>
                </div>
                <div class="col-auto ms-auto">
                <a href="index.php" class="btn btn-dark">Back</a>
                </div>
            </div>
            <div class="card-body">
            <form method="POST">
                <h4>User Name: <?php echo $username; ?></h4>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    <input type="hidden" name="username" value="<?php echo $username; ?>" required>
                    
                </div>
                                
                <div class="mb-4 form-outline">
                    <label for="email" class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="admin" <?php if ($role === 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="user" <?php if ($role === 'user') echo 'selected'; ?>>User</option>
                        <option value="manager" <?php if ($role === 'manager') echo 'selected'; ?>>Manager</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>
        </div>

    </div>

<?php include_once '../partials/footer.php'  ?>

