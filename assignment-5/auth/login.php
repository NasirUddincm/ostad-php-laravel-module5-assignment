<?php
include_once '../partials/header.php';
session_start();
$userError = '';
$emailError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Initialize $userFound to false
  $userFound = false;

  // Search for a user with the provided email
  $userFiles = glob("../users/*.txt");

  foreach ($userFiles as $userFile) {
      $user_data = file_get_contents($userFile);
      $user_info = explode("\n", $user_data);
      $stored_email = trim(explode(":", $user_info[1])[1]);
      $stored_password = trim(explode(":", $user_info[2])[1]);
      $role = trim(explode(":", $user_info[3])[1]); // Get the role      
    
      if ($stored_email === $email && password_verify($password, $stored_password)) {
          $userFound = true;
          
          $_SESSION['username'] = basename($userFile, '.txt');
          $_SESSION['role'] = $role;

          // Redirect based on the user's role
          if ($role === 'admin') {
              header("Location: ../admin_dashboard.php");
          } elseif ($role === 'manager') {
              header("Location: ../manager_dashboard.php");
          } elseif ($role === 'user') {
              header("Location: ../user_dashboard.php");
          }
          exit();
      }
  }

  if (!$userFound) {
    $emailError = '<p class="text-danger text-center"><b>Invalid email or password.</b></p>';
}
}



?>

  
<section class="vh-100 gradient-custom" style="background-color: #ddd;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
          <form action="login.php" method="post">
            <div class="mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="email"class="form-control form-control-lg" name="email" placeholder="E-mail" required/>

                <div class="text-danger text-center">
                    <?php if (isset($emailError)) echo $emailError; ?>
                </div>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required/>
              </div>

              <button class="btn btn-outline-success btn-lg px-5" type="submit">Login</button>

            </div>
        </form>
            <div>
              <p class="mb-0">Don't have an account? <a href="register.php" class="fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once '../partials/footer.php'; ?>



