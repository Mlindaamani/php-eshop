<?php
// Get the database connection object and call the function associated with this connections.
include 'db_connection.php';

//Create the autoloader class function.
spl_autoload_register(function ($class) {
  require "$class.php";
});


//Check whether the submit button is clicked.
if (isset($_POST['submit'])) {

  //Get the form input fields.
  $first_name = $_POST['firstname'];

  $last_name = $_POST['lastname'];

  $email = $_POST['email'];

  $password = $_POST['password'];

  // Hash the input password from the form using password_has() built-in password hash alogorithm
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);


  //Ensure the fields are not empty when the form is submitted
  if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
    header('Location: ../signup.php?emptyfield');
    exit;
  }

  // Query the database for a email and firstname.
  $sql_query = "SELECT email, first_name FROM users WHERE email = '$email' AND first_name ='$first_name'";

  //Get user user data as an associative array.
  $userdata = mysqli_query(databaseConnection(), $sql_query);


  // Redirect the user to signup page if the provided credentials already present in the database.
  if (mysqli_num_rows($userdata) == 1) {
    header('Location: ../signup.php?datapresent');
    exit();

    // Insert the data into the database if the above conditionals are correct.
  } else {
    $sql = "INSERT INTO users(first_name,last_name, email, password) VALUES('$first_name','$last_name','$email', '$hashed_password')";

    // Excute the query
    $result = mysqli_query(databaseConnection(), $sql);

    //Redirect the user to product listing page with the success message
    if ($result) {
      header('Location: ../index.php?success');
      exit();
    }
  }
}