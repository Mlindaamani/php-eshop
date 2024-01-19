<?php
require_once __DIR__ . '/includes/functions.php';

require_once __DIR__ . '/config/autoloader.php';


if (User::logout()) {
  redirectTo('index.php?guest');
}
