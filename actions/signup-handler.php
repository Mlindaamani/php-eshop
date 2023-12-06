<?php
define("DEFAULT_SYSTEM_USER", 'customer');

spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});

require __DIR__ . '/../includes/functions.php';

$user = new User(new Database);

//Validate user inputs.
$email = validateInputs($_POST['email']);

$password = validateInputs($_POST['password']);

$firstname = validateInputs($_POST['firstname']);

$lastname = validateInputs($_POST['lastname']);

//Validate fields.
if (
  empty($email) || empty($password) || empty($firstname) || empty($lastname)
) {
  redirectTo('../signup.php', 'error');
}

//Register.
if (getRequestMethod() === "POST") {
  if (!$user->isUserPresent($email)) {
    $user->register($firstname, $lastname, $email, $password, DEFAULT_SYSTEM_USER);
    redirectTo('../index.php', 'success');
  } else {
    redirectTo('../signup.php', 'datapresent');
  }
}