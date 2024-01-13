<?php
require_once __DIR__ . '/includes/functions.php';

spl_autoload_register(fn($class) => require_once __DIR__ . "/models/$class.php");

if (User::logout()) {
  redirectTo('index.php?guest');
}
