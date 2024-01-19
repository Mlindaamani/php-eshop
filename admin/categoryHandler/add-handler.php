<?php

require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../config/autoloader.php";
require_once __DIR__ . "/../../config/instances.php";


  if (empty($_POST['category_name'])) {
    redirectTo('../category-form.php?emptyCategoryField');
  }

  if ($category->isCategoryPresent($_POST['category_name'])) {
    redirectTo('../category-form.php?present');

  } else {
    $category->addCategory($_POST['category_name']);
    redirectTo('../category-form.php?cat');
  }
