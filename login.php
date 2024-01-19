<?php
require_once __DIR__ . "/config/config.php";
$title = LOGIN;
require_once __DIR__ . '/includes/header.php';

generateAlert('error', 'Invalid Email or password!', 'danger');

generateAlert('emptyfield', 'Fill in all the required fields!', 'danger');

generateAlert('login', 'login/signup to add product to cart', 'info');
?>

<div class="container d-flex justify-content-center align-items-center mt-5">
  <form method="POST" class="border shadow p-3 rounded w-25 mt-5" action="actions/login-handler.php">
    <div class=" mb-4">
      <h5 class="text-center p-3 fw-bold text-success">LOGIN</h5>

      <div class="mb-4">
        <div class="form-floating">
          <input type="email" name="email" id="email" class="form-control text-success" placeholder="Enter email">
          <label for="email" class="form-label">Enter email</label>
        </div>
      </div>

      <div class="mt-3 form-group">
        <div class="form-floating">
          <input type="password" name="password" id="password" class="form-control text-success" placeholder="password">
          <label for="password" class="form-label">Enter password</label>
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" name="submit" class="btn btn-success w-100 mt-5 mb-3" value="login">Login</button>
      </div>
      <div class="mt-2 form-group">
        <p class="text-success">Don't have an account? <a href="signup.php" class="text-success">Register</a></p>
        </di>
  </form>
</div>
<?php require_once __DIR__ . '/includes/script.php' ?>