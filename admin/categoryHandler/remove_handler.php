<?php
//Include Category class and instantiate it.
include "../../models/Category.php";
//Include database class.
include '../../models/Database.php';
$category = new Category(new Database);

// Delete categories with a given id 
if (isset($_POST['remove'])) {

  if (empty($_POST['category_id'])) {
    header('Location: ../removecategory.php?selectCat');
    exit;

  } else {
    $category->deleteCategory($_POST['category_id']);
    header('Location: ../removecategory.php?catdeleted');
    exit();
  }

}