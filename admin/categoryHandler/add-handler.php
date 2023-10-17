<?php
//Include Category class and instantiate it.
include "../../models/Category.php";
//Include database class.
include '../../models/Database.php';

$category = new Category(new Database);

if (isset($_POST['submit'])) {

  //Chech Whether add category filed is not empty
  if (empty($_POST['category_name'])) {
    //Redirect with message
    header('Location: ../category-form.php?emptyCategoryField');
    exit;
  }

  //Check whether the category is already present in categories table.
  if ($category->isCategoryPresent($_POST['category_name'])) {
    header('location: ../category-form.php?present');
    exit();

  } else {
    //Add  the category if not alreaady added.
    $category->addCategory($_POST['category_name']);
    header('location: ../category-form.php?cat');
    exit();
  }
}