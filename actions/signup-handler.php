<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";
require_once __DIR__ . '/../includes/functions.php';



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