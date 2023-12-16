<?php
session_start();

include_once '../includes/functions.php';

spl_autoload_register(fn($class) => require_once __DIR__ . "/../models/{$class}.php");


$user = new User(new Database);

$email = validateInputs($_POST['email']);

$password = validateInputs($_POST['password']);

if (empty($email) || empty($password)) {
    redirectTo("../login.php?emptyfield");
}

if (!$user->login($email, $password)) {
    redirectTo('../login.php?error');
} else {
    $user->login($email, $password);
    redirectTo('../index.php');
}