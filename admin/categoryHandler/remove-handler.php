<?php
//Include Category class and instantiate it.
spl_autoload_register(function ($class) {
  require __DIR__ . "/../../models/$class.php";
});
require_once __DIR__ . '/../../includes/functions.php';

$category = new Category(new Database);

// Delete categories with a given id 
if (isset($_POST['remove'])) {

  if (empty($_POST['category_id'])) {
    redirectTo('../remove-cat-form.php', 'selectCat');


  } else {
    $category->deleteCategory($_POST['category_id']);
    redirectTo('../remove-cat-form.php', 'catdeleted');
  }
}