<?php
// Start the session if not already started here.
@session_start();

//Create an array that contains all the roles.
$role = ['admin', 'customer'];


$accessPermissions = [
  'admin' => isset($_SESSION['role']) && $_SESSION['role'] == 'admin',
  'customer' => isset($_SESSION['role']) && ($_SESSION['role'] == 'customer' || $_SESSION['role'] == 'admin')
];


function access(string $role)
{
  global $accessPermissions;

  if (isset($accessPermissions[$role]) && !$accessPermissions[$role]) {
    header('Location: http://localhost:8000/denied.php');
    exit;
  }
}