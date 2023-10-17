<?php
// session_start();

// include 'mlinda.php';

// $data = [
//   'name' => 'Don',
//   'age' => 40
// ];



// foreach ($data as $key) {
//   $yes = (array_key_exists('nahsme', $data)) ?? 'Amani';
// }

// echo $yes;

// $first_name = $_POST['firstname'];

// $last_name = $_POST['lastname'];
// $email = $_POST['email'];

//Check whether fielsd are empty.
// if (check_empty_field($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
//   redirectTo("../signup.php", "emptyfield");
// } else {
//   echo "Hello world";
// }



//Verify first_name
// if (!isFirstNameValid($_POST['$firstname'])) {
//   isPasswordValid($_POST['$password']);
//   redirectTo("../signup.php");
// }

// //Verify last_name
// if (isLastNameValid($_POST['lastname']))
//   isPasswordValid($_POST['$password']);

// //Verify password
// if (!isPasswordValid($_POST['$password']))
//   redirectTo("../signup.php");


// //Check Whether a user is present in the database.
// if ($user->isUserPresent($_POST['email'])) {
//   redirectTo("../signup.php", "datapresent");
// }


//Create a new accpount if the user info are not present in the database.
// if (!$user->isUserPresent($_POST['email'])) {
//   //Call register method.
//   $user->register($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], 'customer');
//   //Redirect to home page.
//   redirectTo("../index.php", "success");
// }
// }




// // Check whether the submit button is clicked.
// if (isset($_POST['submit'])) {

//   //Get the form input fields.
//   $first_name = $_POST['firstname'];

//   $last_name = $_POST['lastname'];

//   $email = $_POST['email'];

//   $password = $_POST['password'];

//   // Hash the input password from the form using password_has() built-in password hash alogorithm
//   $hashed_password = password_hash($password, PASSWORD_DEFAULT);


//   //Ensure the fields are not empty when the form is submitted
//   if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
//     header('Location: ../signup.php?emptyfield');
//     exit;
//   }

//   // Query the database for a email and firstname.
//   $sql_query = "SELECT email, first_name FROM users WHERE email = '$email' AND first_name ='$first_name'";

//   //Get user user data as an associative array.
//   $userdata = mysqli_query(databaseConnection(), $sql_query);


//   // Redirect the user to signup page if the provided credentials already present in the database.
//   if (mysqli_num_rows($userdata) == 1) {
//     header('Location: ../signup.php?datapresent');
//     exit();

//     // Insert the data into the database if the above conditionals are correct.
//   } else {
//     $sql = "INSERT INTO users(first_name,last_name, email, password) VALUES('$first_name','$last_name','$email', '$hashed_password')";

//     // Excute the query
//     $result = mysqli_query(databaseConnection(), $sql);

//     //Redirect the user to product listing page with the success message
//     if ($result) {
//       header('Location: ../index.php?success');
//       exit();
//     }
//   }
