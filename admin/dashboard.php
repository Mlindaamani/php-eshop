<!-- Include the header contents -->
<?php
require_once __DIR__ . '/../includes/header.php';

// Include the accessibilty function
include_once __DIR__ . '/../access.php';

// // Call the access() and pass string admin as a argument
access('admin');
?>


<div class="row mt-3">
  <?php generateAlert('admin', ' Welcome Back!', 'success'); ?>

  <!--Sidepanel -->
  <div class="col-md-2 mt-3">
    <?php require_once __DIR__ . '/../includes/sidepanel.php' ?>
  </div>

  <!-- 10 columns layout -->
  <div class="col-md-10 mt-3 border shadow" style="height:100%"></div>
</div>
<!-- Include the footer contents in the login page. -->
<?php require_once __DIR__ . '/../includes/script.php' ?>