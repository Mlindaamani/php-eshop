<?php
require_once __DIR__ . "/../config/config.php";
$title = DASHBOARD;
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . "/../includes/functions.php";
checkAccess(["admin", "mod"], "../denied.php");
?>

<div class="row mt-3">
  <!--Sidepanel -->
  <div class="col-md-2 mt-3">
    <?php require_once __DIR__ . '/../includes/sidepanel.php' ?>
  </div>

  <!-- 10 columns layout -->
  <div class="col-md-10 mt-3 border shadow" style="height:100%"></div>
</div>
<?php require_once __DIR__ . '/../includes/script.php';