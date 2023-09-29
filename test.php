<?php

function displayErrorMessage(string $error, string $message, string $alert_type): void
{

  if (isset($_GET[$error])) {
    echo "<div class='alert alert-$alert_type alert-dismissible show' role='alert'>
    $message
    <button class='btn-close' data-bs-dismiss='alert' aria-lable='Close'></button>
  </div>";
  }
}