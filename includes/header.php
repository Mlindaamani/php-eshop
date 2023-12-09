<?php
//Start session.
session_start();

error_reporting(0);

require_once __DIR__ . "/../config/config.php";

spl_autoload_register(function ($class) {
  require __DIR__ . "/../models/$class.php";
});

$cartItem = new CartItem(new Database);

$user = new User(new Database);

/**
 * Summary of display_logout
 * @param User $user
 * @return void
 */
function display_logout(User $user, $baseUrl)
{
  if ($user->isLoggedIn()):
    ?>
    <a class="btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= $baseUrl ?>/logout.php">Logout</a>
    <?php
  endif;
}


/**
 * Summary of display_login
 * @param User $user
 * @return void
 */
function display_login(User $user, $baseUrl)
{
  if (!$user->isLoggedIn()):
    ?>
    <a class="btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= $baseUrl ?>/login.php">Login</a>
    <?php
  endif;
}

/**
 * Summary of displayDashboard
 * @param User $user
 * @return void
 */
function displayDashboard(User $user, $baseUrl)
{
  if ($user->isLoggedIn() && $user->isAdmin($_SESSION[CURRENT_USER])):
    ?>
    <a class="btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= $baseUrl ?>/../admin/dashboard.php">Dashboard</a>
    <?php
  endif;
}

/**
 * Summary of displayProfile
 * @param User $user
 * @return void
 */
function displayProfile(User $user, $baseUrl)
{
  global $baseUrl;
  if ($user->isLoggedIn() && !$user->isAdmin($_SESSION[CURRENT_USER])):
    ?>
    <a class="btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= $baseUrl ?>/profile.php">Profile</a>
    <?php
  endif;
}


/**
 * Summary of display_signup
 * @param User $user
 * @return void
 */
function display_signup(User $user, $baseUrl)
{
  if (!$user->isLoggedIn()):
    ?>
    <a class="btn btn-primary text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= $baseUrl ?>/signup.php">Sign-up</a>
    <?php
  endif;
}


/**
 * Summary of generateAlert
 * @param mixed $getKey
 * @param mixed $message
 * @param mixed $alertType
 * @return void
 */
function generateAlert($getKey, $message, $alertType)
{
  if (isset($_GET[$getKey])):
    ?>
    <div class="container alert alert-<?= $alertType ?> alert-dismissible fade show  mt-2" role="alert">
      <?= $message ?>
      <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  endif;
}

/**
 * Summary of displayCart
 * @param CartItem $cartItem
 * @param User $user
 * @param mixed $baseUrl
 * @return void
 */
function displayCart(CartItem $cartItem, User $user, $baseUrl)
{
  ?>
  <button type="button" class="btn btn-primary mx-3 fw-bold">
    <a class="nav-link fw-bold-semi-bold text-light" href="<?= $baseUrl ?>/cart/cart.php"> Cart
      <sup class=" cart-count fw-bold">
        <?= (!isset($_SESSION[CURRENT_USER])) ? EMPTY_CART_VALUE : $cartItem->getItemsCount($_SESSION[CURRENT_USER]) ?>
      </sup>
    </a>
  </button>
  <button type="button" class="btn btn-primary mx-3 fw-bold">
    <span>
      <?= (!isset($_SESSION[CURRENT_USER])) ? USER_DEFAULT : $user->authUser($_SESSION[CURRENT_USER]) ?>
    </span>
  </button>
  <?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $title ?? "" ?>
  </title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary text-light sticky-top">
    <div class="container-fluid p-1">
      <a class="navbar-brand text-light fw-bold text active mx-3 mt-1 logo" href="/">
        <?= APP_NAME ?>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="nav-menu">
        <ul class="navbar-nav me-auto  mb-lg-0">
          <li class="nav-item">
            <a href="<?= BASE_URL ?>" class="nav-link active fw-bold text-light">Home
            </a>
          </li>

          <li class="nav-item">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Categories</button>
          </li>
        </ul>
        <div class="px-3 py-2 m-3 text-end">
          <div class="container d-flex flex-wrap justify-content-center">
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto mx-3" role="search">
              <input type="search" class="form-control" placeholder="Search...">
            </form>
            <div>
              <?php display_logout($user, BASE_URL) ?>
              <?php display_login($user, BASE_URL) ?>
              <?php display_signup($user, BASE_URL) ?>
              <?php displayDashboard($user, BASE_URL) ?>
              <?php displayProfile($user, BASE_URL) ?>
              <?php displayCart($cartItem, $user, BASE_URL) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <body>