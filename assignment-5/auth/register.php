<?php
include_once '../partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = 'user';
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



<!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class=" d-flex justify-content-center align-items-center">
        
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <h3>Register User</h3>
              <form action="register.php" method="post">
                <!-- User Name input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required/>
                    <div class="text-danger" id="username-error">
                        <?php if (isset($usernameError)) echo $usernameError; ?>
                    </div>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email address</label>
                  <input type="email" id="email" name="email" class="form-control" required/>
                  <div class="text-danger" id="username-error">
                        <?php if (isset($emailError)) echo $emailError; ?>
                    </div>
                </div>
                
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="pass">Password</label>
                  <input type="password" id="pass" name="password" class="form-control" required/>
                </div>
               
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Sign up
                </button>

              </form>
              <div>
              <p class="mb-0">have an account? <a href="login.php" class="fw-bold">Login</a>
              </p>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->

<?php include_once '../partials/footer.php'; ?>
