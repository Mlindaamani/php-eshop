<?php
session_start();

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/autoloader.php';
require_once __DIR__ . '/../config/instances.php';

// $user = new User(new Database);

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