<!-- Include the header contents -->
<?php include '../includes/header.php';


// Include the accessibilty function
include '../access.php';

// Call the access() and pass string admin as a argument
access('admin'); ?>


<div class="row mt-3">
  <?php if (isset($_GET['admin'])) { ?>
    <div class="alert alert-success alert-dismissible container text-center mt-2 fade show" role="alert">
      Welcome Back!
      <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
    </div>
  <?php } ?>

  <!--Sidepanel -->
  <div class="col-md-2 border shadow mt-3">
    <?php include '../includes/sidepanel.php'; ?>
  </div>

  <!-- 10 columns layout -->
  <div class="col-md-10 mt-3 border shadow" style="height:100%"></div>
</div>
<!-- Include the footer contents in the login page. -->
<?php include '../includes/script.php' ?>