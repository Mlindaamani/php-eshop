<?php
require_once __DIR__ . "/../config/config.php";
spl_autoload_register(fn($class) => require_once __DIR__ . "/../models/{$class}.php");
require __DIR__ . '/../includes/functions.php';
$user = new User(new Database);


$email = validateInputs($_POST['email']);
$password = validateInputs($_POST['password']);
$firstname = validateInputs($_POST['firstname']);
$lastname = validateInputs($_POST['lastname']);

if (
  empty($email) || empty($password) || empty($firstname) || empty($lastname)
) {
  redirectTo('../signup.php?error');
}


if (isRequestMethodPost()) {
  if (!$user->isUserPresent($email)) {
    $user->register($firstname, $lastname, $email, $password, DEFAULT_SYSTEM_USER);
    redirectTo('../index.php?success');
  } else {
    redirectTo('../signup.php?datapresent');
  }
}