<?php
// Include the header contents in the login page. -->
require_once __DIR__ . '/includes/header.php';

//Disply the error message when the password or email does not match. -->
generateAlert('error', 'Invalid Email or password!', 'danger');
// Disply error message when the fields are empty. -->
generateAlert('emptyfield', 'Fill in all the required fields!', 'danger');
//Display the error message when the user tries to add product in the cart_items table 
generateAlert('login', 'login/signup to add product to cart', 'info');

?>

<!-- login form -->
<div class="container d-flex justify-content-center align-items-center mt-5">
  <form method="POST" class="border shadow p-3 rounded w-25 mt-5" action="actions/auth-user.php">
    <div class=" mb-4">
      <h5 class="text-center p-3">LOGIN</h5>

      <div class="mb-4">
        <div class="form-floating">
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
          <label for="email" class="form-label">Enter email</label>
        </div>
      </div>

      <div class="mt-3 form-group">
        <div class="form-floating">
          <input type="password" name="password" id="password" class="form-control" placeholder="password">
          <label for="password" class="form-label">Enter password</label>
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" name="submit" class="btn btn-primary w-100 mt-5 mb-3">Login</button>
      </div>
      <div class="mt-2 form-group">
        <p>Don't have an account? <a href="signup.php">Register</a></p>
        </di>
  </form>
</div>
<!-- Include the footer contents in the login page. -->
<?php __DIR__ . '/includes/script.php' ?>