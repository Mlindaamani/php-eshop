<?php
//Start session inorder to use the superglobal session.
@session_start();
//Create a baseUrl with localhost as the name of the server and port 8000 as the default port for PHP x-debug
$baseUrl = 'http://localhost:8000';

// Checks whether the user is logged in. Rerurn True on success and false on failure.
function is_logged_in()
{
  return isset($_SESSION['user_id']);
}

//Display logout button link
function display_logout()
{
  global $baseUrl;
  if (is_logged_in()) {
    echo "<a class='btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none' href=$baseUrl/logout.php>Logout</a>";
  }
}

// Disply the login button-link if the user is currently not logged in
function display_login()
{
  global $baseUrl;
  if (!is_logged_in()) {
    echo "<a class='btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none' href=$baseUrl/login.php>Login</a>";
  }
}

// Disply the signup  button-link if the user is currently not logged in
function display_signup()
{
  global $baseUrl;
  if (!is_logged_in()) {
    echo "<a class='btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none' href=$baseUrl/signup.php>Sign-up</a>";
  }
}

function generateAlert($getKey, $message, $alertType)
{
  if (isset($_GET[$getKey])) {
    echo '<div class="alert alert-' . $alertType . ' alert-dismissible fade show container mt-2" role="alert">';
    echo $message;
    echo '<button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
  }
} ?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Home</title>
  <link rel='stylesheet' href='../assets/css/style.css'>
  <link rel='stylesheet' href='../assets/css/bootstrap.css'>
  <link rel='stylesheet' href='../assets/css/table.css'>
</head>

<body>
  <nav class='navbar navbar-expand-lg bg-primary text-light sticky-top'>
    <div class='container-fluid p-1'>
      <a class='navbar-brand text-light fw-bold text active mx-3' href='#'><span class="logo">E</span>BOT </a>
      <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#nav-menu'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse ' id='nav-menu'>
        <ul class='navbar-nav me-auto  mb-lg-0'>
          <li class='nav-item'>
            <a href="<?= $baseUrl ?>" class='nav-link active fw-bold text-light'>Home
            </a>
          </li>
          <?php display_logout() ?>
        </ul>
        <div class="px-3 py-2 m-3 text-end">
          <div class="container d-flex flex-wrap justify-content-center">
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto mx-3" role="search">
              <input type="search" class="form-control" placeholder="Search...">
            </form>
            <div>
              <?php display_login() ?>
              <?php display_signup() ?>
              <button type="button" class="btn btn-primary mx-3 fw-bold">
                <a class='nav-link fw-bold-semi-bold text-light' href='<?php $baseUrl ?>cart/cart.php'>Cart</a>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>