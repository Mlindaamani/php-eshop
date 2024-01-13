<?php

function checkAccess(array $allowedRoles, string $url)
{

  if (!is_null(User::role())) {

    if (in_array(User::role(), $allowedRoles)) {

      return true;
    }
  } else {
    redirectTo($url);
  }
}

/**
 * Summary of isRequestMethodPost
 * @return bool
 */
function isRequestMethodPost()
{
  return strtoupper($_SERVER['REQUEST_METHOD']) === "POST";
}

/**
 * Summary of isRequestMethodGet
 * @return bool
 */
function isRequestMethodGet()
{
  return strtoupper($_SERVER['REQUEST_METHOD']) === "GET";
}

/**
 * Summary of validateInputs
 * @param string $data
 * @return string
 */
function validateInputs(string $data)
{
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = stripslashes($data);
  return $data;
}

/**
 * Summary of redirectTo
 * @param string $url
 * @return never
 */
function redirectTo(string $url)
{
  header("Location: $url");
  exit();
}

/**
 * Summary of escapeChars
 * @param mixed $data
 * @return string
 */
function escapeChars($data)
{
  return htmlspecialchars($data);
}