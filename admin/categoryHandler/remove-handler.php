<?php

require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../config/autoloader.php";
require_once __DIR__ . "/../../config/instances.php";


if (isset($_POST['remove'])) {

  if (empty($_POST['category_id'])) {
    redirectTo('../remove-cat-form.php?selectCat');

  } else {
    $category->deleteCategory($_POST['category_id']);
    redirectTo('../remove-cat-form.php?catdeleted');
  }
}