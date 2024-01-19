<?php
//Start session.
session_start();
error_reporting(0);
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/autoloader.php";
require_once __DIR__ . "/../config/instances.php";


/**
 * Summary of display_logout
 * @param mixed $baseUrl
 * @return void
 */
function display_logout(string $baseUrl)
{
  if (User::isLoggedIn()):
    ?>
    <a class="btn btn-success text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= htmlspecialchars($baseUrl) ?>/logout.php">Logout</a>
    <?php
  endif;
}

/**
 * Summary of display_login
 * @param mixed $baseUrl
 * @return void
 */
function display_login(string $baseUrl)
{
  if (!User::isLoggedIn()):
    ?>
    <a class="btn btn-success text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= htmlspecialchars($baseUrl) ?>/login.php">Login</a>
    <?php
  endif;
}

/**
 * Summary of displayDashboard
 * @param string $baseUrl
 * @return void
 */
function display_dashboard(string $baseUrl)
{
  if (User::isLoggedIn() && User::isAdmin()):
    ?>
    <a class="btn btn-success text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= htmlspecialchars($baseUrl) ?>/../admin/dashboard.php">Dashboard</a>
    <?php
  endif;
}

/**
 * Summary of displayProfile
 * @param string $baseUrl
 * @return void
 */
function display_profile(string $baseUrl)
{

  if (User::isLoggedIn() && !User::isAdmin()):
    ?>
    <a class="btn btn-success text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= htmlspecialchars($baseUrl) ?>/profile.php">Profile</a>
    <?php
  endif;
}

/**
 * Summary of display_signup
 * @param string $baseUrl
 * @return void
 */
function display_signup(string $baseUrl)
{
  if (!User::isLoggedIn()):
    ?>
    <a class="btn btn-success text-light me-1 fw-bold btn-link text-decoration-none mx-3"
      href="<?= htmlspecialchars($baseUrl) ?>/signup.php">Sign-up</a>
    <?php
  endif;
}

/**
 * Summary of generateAlert
 * @param string $getKey
 * @param string $message
 * @param string $alertType
 * @return void
 */
function generateAlert(string $getKey, string $message, string $alertType)
{
  if (isset($_GET[$getKey])):
    ?>
    <div class="container alert alert-<?= htmlspecialchars($alertType) ?> alert-dismissible fade show  mt-2" role="alert">
      <?= htmlspecialchars($message) ?>
      <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
  endif;
}

/**
 * Summary of displayCart
 * @param CartItem $cartItem
 * @param string $baseUrl
 * @return void
 */
function display_cart(CartItem $cartItem, string $baseUrl)
{
  if (User::isLoggedIn()):
    ?>
    <button type="button" class="btn btn-success mx-3 fw-bold">
      <a class="nav-link fw-bold text-light" href="<?= htmlspecialchars($baseUrl) ?>/cart/cart.php"> Cart
        <sup class=" cart-count fw-bold text-light">
          <?= (is_null(User::id())) ? EMPTY_CART_VALUE : $cartItem->getItemsCount(User::id()) ?>
        </sup>
      </a>
    </button>
    <?php
  endif;
}


/**
 * Summary of displayGuest
 * @param User $user
 * @return void
 */
function display_guest(User $user)
{
  ?>
  <span class="fw-bold">
    <?= (is_null(User::id())) ? USER_DEFAULT : $user->authUser(User::id()) ?>
  </span>
  <?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="15">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= htmlspecialchars($title) ?? "" ?>
  </title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/table.css">
  <link rel="stylesheet" href="../../assets/custom-css/carousel.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-success text-light sticky-top">
    <div class="container-fluid p-1">
      <a class="navbar-brand text-light fw-bold text active mx-3 mt-1 logo" href="/">
        <?= htmlspecialchars(APP_NAME) ?>
      </a>

      <button class="navbar-toggler bg-info-subtle" type="button" data-bs-toggle="collapse" data-bs-target="#nav-menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="nav-menu">
        <ul class="navbar-nav me-auto  mb-lg-0 ">
          <li class="nav-item">
            <a href="<?= htmlspecialchars(BASE_URL) ?>" class="nav-link active fw-bold text-light bg-success">Home
            </a>
          </li>

          <li class="nav-item">
            <button class="btn btn-success" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Categories</button>
          </li>
        </ul>
        <div class="px-3 py-2 m-3 text-end">
          <div class="container d-flex flex-wrap justify-content-center">
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto mx-3" role="search">
              <input type="search" class="form-control text-success" placeholder="Search...">
            </form>
            <div>
              <?php display_logout(BASE_URL) ?>
              <?php display_login(BASE_URL) ?>
              <?php display_signup(BASE_URL) ?>
              <?php display_dashboard(BASE_URL) ?>
              <?php display_profile(BASE_URL) ?>
              <?php display_cart($cartItem, BASE_URL) ?>
              <?php display_guest($user) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <body>