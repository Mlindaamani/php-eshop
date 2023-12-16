<?php

require_once __DIR__ . '/../../includes/functions.php';
spl_autoload_register(fn($class) => require_once __DIR__ . "/../../models/{$class}.php");
$category = new Category(new Database);


if (isset($_POST['remove'])) {

  if (empty($_POST['category_id'])) {
    redirectTo('../remove-cat-form.php?selectCat');

  } else {
    $category->deleteCategory($_POST['category_id']);
    redirectTo('../remove-cat-form.php?catdeleted');
  }
}