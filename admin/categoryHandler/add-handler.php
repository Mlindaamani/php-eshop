<?php
spl_autoload_register(fn($class) => require_once __DIR__ . "/../../models/{$class}.php");
require_once __DIR__ . '/../../includes/functions.php';
$category = new Category(new Database);


  if (empty($_POST['category_name'])) {
    redirectTo('../category-form.php?emptyCategoryField');
  }

  if ($category->isCategoryPresent($_POST['category_name'])) {
    redirectTo('../category-form.php?present');

  } else {
    $category->addCategory($_POST['category_name']);
    redirectTo('../category-form.php?cat');
  }
