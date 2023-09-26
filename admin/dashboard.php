<?php include '../includes/header.php';
include '../access.php';
access('admin'); ?>
<div class="row">
  <?php if (isset($_GET['admin'])) { ?>
    <div class="alert alert-success alert-dismissible show container text-center mt-2" role="alert">
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