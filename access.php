<?php

//Permission Management for customers and admin.
@session_start();
$role = ['admin', 'customer'];
$accessPermissions = [
  'admin' => isset($_SESSION['role']) && $_SESSION['role'] == 'admin',
  'customer' => isset($_SESSION['role']) && ($_SESSION['role'] == 'customer' || $_SESSION['role'] == 'admin')
];


function access($role)
{
  global $accessPermissions;

  if (isset($accessPermissions[$role]) && !$accessPermissions[$role]) {
    header('Location: http://localhost:8000/denied.php');
    exit;
  }
}
?>