<?php


spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});


$user = new User(new Database);
require __DIR__ . '/../includes/functions.php';



if (isset($_POST['submit']) && getRequestMethod() === "POST") {

  $validateUser = new FormValidator($_POST);

  $error = $validateUser->validate_form();

  if ($error['firstname']) {
    redirectTo('../signup.php', 'firstname');
  }

  if (count($error) == 4) {
    redirectTo('../signup.php', 'error');
  }



  if (count($error) == 0) {
    $user->register($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['email'], 'customer');
    redirectTo('../index.php', 'success');
  }
}