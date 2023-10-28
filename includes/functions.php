<?php

/**
 * Summary of redirectTo
 * @param string $file_name
 * @param string $get_variable
 * @return never
 */
function redirectTo(string $file_name, string $get_variable = '')
{
  if ($get_variable):
    header("Location: " . $file_name . "?" . $get_variable);
    exit();

  else:
    header("Location: " . $file_name);
    exit;
  endif;
}



/**
 * Summary of getRequestMethod
 * @return string
 */
function getRequestMethod(): string
{
  return strtoupper($_SERVER['REQUEST_METHOD']);
}


//DEV_STEVE.
//Lets learn ternary operator.

function checkStatuscCode(string $statusCode)
{

  return $statusCode == 200 ? require_once __DIR__ . '../index.php' : require_once __DIR__ . '../register.php';
}