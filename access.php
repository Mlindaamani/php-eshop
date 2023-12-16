<?php
@session_start();

function access(string $role)
{
  $accessPermissions = [
    'admin' => $_SESSION['role'] == 'admin',
    'customer' => $_SESSION['role'] == 'customer' || $_SESSION['role'] == 'admin'
  ];


  if (!$accessPermissions[$role]) {
    // header('Location: http://localhost:8000/denied.php');
    // exit;
    redirectTo(BASE_URL);
  }
}


// function checkAccess(array $allowedRoles, string $file_path)
// {


//   if (isset($_SESSION['role'])) {

//     $user_role = $_SESSION['role'];

//     if (in_array($user_role, $allowedRoles)) {

//       return true;
//     }

//   } else {

//     header("Location: " . $file_path);
//     exit();
//   }
// }