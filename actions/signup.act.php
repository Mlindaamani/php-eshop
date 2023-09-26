<?php
include 'db_connection.php';
spl_autoload_register(function ($class) {
  require "$class.php";
});


if (isset($_POST['submit'])) {
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $phone_number = $_POST['phone'];

  if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($phone_number)) {
    header('Location: ../signup.php?emptyFields');
    exit;
  }

  $sql_query = "SELECT email, first_name FROM users WHERE email = '$email' OR first_name ='$first_name'";
  $userdata = mysqli_query(databaseConnection(), $sql_query);
  if (mysqli_num_rows($userdata) == 1) {
    header('Location: ../signup.php?msg=error');
    exit();

  } else {
    $sql = "INSERT INTO users(
      first_name,
      last_name,
      email,
      phone_number,
      password) 
      VALUES('$first_name','$last_name','$email', '$phone_number', '$hashed_password')";
    $result = mysqli_query(databaseConnection(), $sql);

    if ($result) {
      header('Location: ../index.php?success=yes');
      exit();
    }
  }

}