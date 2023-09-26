<?php
logout();
function logout()
{
  session_start();
  session_regenerate_id(true);
  session_unset();
  session_destroy();
  header('Location: login.php');
  exit;
}