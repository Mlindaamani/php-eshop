<?php
// Include the header contents in the login page. -->
include('includes/header.php');
// Display error if the records are not fouund for the user trying logging in 
generateAlert('norecord', 'No records found for entered user. Kindly signup/login again!', 'danger');
// Display the message if the user records already exist in the database 
generateAlert('datapresent', 'Entered records Already exit!', 'danger');
//Display the error message if the form fields are empty
generateAlert('emptyfield', 'Kindly fill in all the required fields!', 'danger');
?>

<!-- Signed up form -->
<div class="container d-flex justify-content-center align-items-center" style="width: 50%; height:90vh">
  <form action="actions/signup.act.php" method="post" class="border shadow p-3 rounded w-50 ">
    <div class="mb-3">
      <h5 class="text-center p-3">SIGN UP</h5>

      <div class="mb-3">
        <div class="form-floating">
          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="F">
          <label for="firstname" class="form-label">Enter first name</label>
        </div>
      </div>

      <div class="mb-3">
        <div class="form-floating">
          <input type="text" name="lastname" id="lastname" class="form-control" placeholder="L">
          <label for="lastname" class="form-label">Enter last name</label>
        </div>
      </div>

      <div class="mb-3">
        <div class="form-floating">
          <input type="email" name="email" id="" class="form-control" placeholder="E">
          <label for="email" class="form-label is-valid">Enter email</label>
        </div>
      </div>

      <div class="mb-3">
        <div class="form-floating">
          <input type="password" name="password" id="" class="form-control" placeholder="P">
          <label for="password" class="form-label">Enter password</label>
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100 mb-2" name="submit">Sign up</button>
        <p class="mt-2">Already have an account? <a href="login.php">Login</a></p>
      </div>
  </form>
</div>
<!-- Include the footer contents in the login page. -->
<?php include 'includes/script.php' ?>