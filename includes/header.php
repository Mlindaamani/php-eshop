<?php
//Start session.
session_start();
//Disable error reporting for unset user_id.
error_reporting(0);

//Session user_id.
$userId = (int) $_SESSION['user_id'];


//Create a baseUrl with localhost as the name of the server and port 8000 as the default port for PHP x-debug
$baseUrl = 'http://localhost:8000';

//Create the class autoloader function. This function will automatically load the class when a new instance of it is craeted.
spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});

//Create new instance of CartItem class.
$cartItem = new CartItem(new Database);

//Create a user object
$user = new User(new Database);


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
    echo "<a class='btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3' href=$baseUrl/logout.php>Logout</a>";
  }
}

// Disply the login button-link if the user is currently not logged in
function display_login()
{
  global $baseUrl;
  if (!is_logged_in()) {
    echo "<a class='btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3' href=$baseUrl/login.php>Login</a>";
  }
}

// Disply the signup  button-link if the user is currently not logged in
function display_signup()
{
  global $baseUrl;
  if (!is_logged_in()) {
    echo "<a class='btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3' href=$baseUrl/signup.php>Sign-up</a>";
  }
}

//Create a custom method for handling different alerts in my app.
function generateAlert($getKey, $message, $alertType)
{
  if (isset($_GET[$getKey])) {
    echo '<div class=" container alert alert-' . $alertType . ' alert-dismissible fade show  mt-2" role="alert">';
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
      <a class='navbar-brand text-light fw-bold text active mx-3 mt-1 logo' href='/'>
        EBOT
      </a>

      <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#nav-menu'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse ' id='nav-menu'>
        <ul class='navbar-nav me-auto  mb-lg-0'>
          <li class='nav-item'>
            <a href="<?= $baseUrl ?>" class='nav-link active fw-bold text-light'>Home
            </a>
          </li>

          <li class='nav-item'>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Categories</button>
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
                <a class='nav-link fw-bold-semi-bold text-light' href='<?php $baseUrl ?>cart/cart.php'> Cart <sup
                    class="cart-count fw-bold">
                    <?= $cartItem->getItemsCount($userId) ?>
                  </sup></a>
              </button>
              <button type="button" class="btn btn-primary mx-3 fw-bold">
                <span>
                  <?= is_null($userId) ? 'Guest' : $user->authUser($userId) ?>
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <body>