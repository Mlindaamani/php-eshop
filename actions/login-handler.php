<?php
session_start();

include_once '../includes/functions.php';

spl_autoload_register(function ($class) {
    require __DIR__ . "/../models/$class.php";
});

//Create User instance.
$user = new User(new Database);

//Validate the user input.
$email = validateInputs($_POST['email']);
$password = validateInputs($_POST['password']);


//Check for empty fields.
if (empty($email) || empty($password)) {
    redirectTo("../login.php", "emptyfield");
}

//Log in a user.
if (!$user->login($email, $password)) {
    redirectTo('../login.php', 'error');
} else {
    $user->login($email, $password);
    redirectTo('../index.php');
}