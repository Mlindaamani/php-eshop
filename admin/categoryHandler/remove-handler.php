<?php
//Include Category class and instantiate it.
require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../includes/functions.php';

$category = new Category(new Database);

// Delete categories with a given id 
if (isset($_POST['remove'])) {

  if (empty($_POST['category_id'])) {
    redirectTo('../remove-cat-form', 'selectCat');


  } else {
    $category->deleteCategory($_POST['category_id']);
    redirectTo('../remove-cat-form', 'catdeleted');
  }
}