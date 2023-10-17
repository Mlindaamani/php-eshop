<?php


spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});


$user = new User(new Database);
require __DIR__ . '/../includes/functions.php';



if (isset($_POST['submit']) && getRequestMethod() === "POST") {

  $validateUser = new FormValidator($_POST);
  $error = $validateUser->validate_form();
  var_dump($error);
}