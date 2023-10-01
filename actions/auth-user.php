<?php
session_start();
//Get database connection object
include 'db_connection.php';

//Check if the submit button is clicked
if (isset($_POST['submit'])) {

    // Get email and password from the form.
    $enteredEmail = $_POST['email'];

    $enteredPassword = $_POST['password'];

    // Check whether the fields for password and email are filled with the message if empty.
    if (empty($enteredEmail) || empty($enteredPassword)) {
        header('Location:../login.php?emptyfield');
        exit;
    }

    //Select user info with the provide email.
    $result = mysqli_query(databaseConnection(), "SELECT * FROM users WHERE email = '$enteredEmail'");


    // Check whether the user is present in the database.
    if (mysqli_num_rows($result) == 1) {

        // Get user data as an associative array.
        $row = mysqli_fetch_assoc($result);

        //Use the verify password to compare the hashed password with the entered password.
        if (password_verify($enteredPassword, $row['password'])) {

            //Store the role in the session superglobal variable.
            $_SESSION['role'] = $row['role'];

            //Store the user_id in the superglobal variable.
            $_SESSION['user_id'] = $row['id'];


            //Reddirect a user to admin page if their role is admin.
            if ($row['role'] == 'admin') {
                header('Location: ../admin/dashboard.php?admin');
                exit();

                //Redirect the authenticated used to home page.
            } else {
                header('Location: ../index.php');
                exit();
            }

            //Redirect the user to the home login page when the entered password does not match with database records.
        } else {
            header('Location: ../login.php?error');
            exit();
        }

        //Redirect the user to the signup page if their records are not present in the database.
    } else {
        header('Location: ../signup.php?norecord');
    }
}