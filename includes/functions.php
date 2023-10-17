<?php



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


function getRequestMethod(): string
{
  return strtoupper($_SERVER['REQUEST_METHOD']);
}