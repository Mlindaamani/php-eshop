<?php
require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../includes/functions.php';
$category = new Category(new Database);

if (isset($_POST['submit'])) {

  //Chech Whether add category filed is not empty
  if (empty($_POST['category_name'])) {
    //Redirect with message
    redirectTo('../category-form', 'emptyCategoryField');

  }

  //Check whether the category is already present in categories table.
  if ($category->isCategoryPresent($_POST['category_name'])) {
    redirectTo('../category-form', 'present');

  } else {
    //Add  the category if not alreaady added.
    $category->addCategory($_POST['category_name']);
    redirectTo('../category-form', 'cat');
  }
}