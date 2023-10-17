<?php
require_once __DIR__ . '/includes/functions.php';

function logout()
{
  session_start();

  //Redigenerate the session ID when user logs out
  session_regenerate_id(true);

  //Unset session variable.
  session_unset();

  //Destroy the entire session.
  session_destroy();

  //Redirect to login.php
  redirectTo('login.php');
}

//Call the logout function.
logout();