<?php
include_once '../partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $userExists = false;

    // Check if the username exists
    if (file_exists("../users/$username.txt")) {
        $userExists = true;
        $usernameError = '<p class="text-danger"><b>Username already exists. Please choose a different one.</b></p>';
    }

    // Check if the email exists
    $userFiles = glob("../users/*.txt");
    foreach ($userFiles as $userFile) {
        $userData = file_get_contents($userFile);
        $userInfo = explode("\n", $userData);
        $storedEmail = trim(explode(":", $userInfo[1])[1]);

        if ($storedEmail === $email) {
            $userExists = true;
            $emailError = '<p class="text-danger"><b>Email already exists. Please use a different one.</b></p>';
            break;
        }
    }

    if (!$userExists) {
        $user_data = "Username: $username\nEmail: $email\nPassword: $password\nRole: $role";
        file_put_contents("../users/$username.txt", $user_data);
        echo "Registration successful!";
        header("Location: ../auth/login.php");
        exit();
    }
}
?>


<section class="container mt-3">
    <div class="card">
       
        <div class="card-header row mx-0">
            <div class="col-auto">
                <h4>Create User & Role</h4>
            </div>
            <div class="col-auto ms-auto">
                <a href="index.php" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
        <form action="create.php" method="post">
            <!-- User Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" />
                <div class="text-danger" id="username-error">
                    <?php if (isset($usernameError)) echo $usernameError; ?>
                </div>
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-control" />
                <div class="text-danger" id="username-error">
                    <?php if (isset($emailError)) echo $emailError; ?>
                </div>
            </div>
            <div class="mb-4 form-outline">
                <label for="email" class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="pass">Password</label>
                <input type="password" id="pass" name="password" class="form-control" />
            </div>
            
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">
                Submit
            </button>

            </form>
        </div>
    </div>
</section>


<?php include_once '../partials/footer.php'; ?>
