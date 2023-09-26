<?php include('includes/header.php') ?>
<div class="container d-flex justify-content-center align-items-center" style="width: 100%; height:90vh">
  <form action="actions/signup.act.php" method="post" class="border shadow p-3 rounded w-50">
    <div class="mb-3">
      <h5 class="text-center p-3">SIGN UP</h5>
      <?php if (isset($_GET['msg'])) { ?>
        <div class="alert alert-danger alert-dismissible show" role="alert">
          Entered records Already exit!
          <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
        </div>
      <?php } ?>
      <?php if (isset($_GET['emptyFields'])) { ?>
        <div class="alert alert-danger alert-dismissible show" role="alert">
          Kindly fill in the required fields to proceed!
          <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
        </div>
      <?php } ?>
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
        <div class="form-floating">
          <input type="text" name="phone" id="phonenumber" class="form-control" placeholder="N">
          <label for="phonenumber" class="form-label">Enter Phone number</label>
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100 mb-2" name="submit">Sign up</button>
        <p class="mt-2">Already have an account? <a href="login.php">Login</a></p>
      </div>
  </form>
  <?php include 'includes/footer.php' ?>
</div>