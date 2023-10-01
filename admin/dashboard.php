<!-- Include the header contents -->
<?php include '../includes/header.php';


// Include the accessibilty function
include '../access.php';

// Call the access() and pass string admin as a argument
access('admin'); ?>


<div class="row">
  <?php if (isset($_GET['admin'])) { ?>
    <div class="alert alert-success alert-dismissible container text-center mt-2 fade show" role="alert">
      Welcome Back!
      <button class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
    </div>
  <?php } ?>
  <div class="col-md-2">
    <?php include '../includes/sidepanel.php'; ?>
  </div>
  <div class="col-md-10"></div>
</div>
<?php include '../includes/footer.php' ?>