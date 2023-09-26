<?php
session_start();
include 'db_connection.php';

if (isset($_POST['submit'])) {

    $enteredEmail = $_POST['email'];

    $enteredPassword = $_POST['password'];

    if (empty($enteredEmail) || empty($enteredPassword)) {
        header('Location:../login.php?emptyfields');
        exit;
    }

    if (strlen($enteredPassword) < 3) {
        header('Location: ../login.php?shortpassword');
        exit;
    }

    $result = mysqli_query(databaseConnection(), "SELECT * FROM users WHERE email = '$enteredEmail'");
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($enteredPassword, $row['password'])) {
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];

            if ($row['role'] == 'admin') {
                header('Location: ../admin/dashboard.php?admin');
                exit();
            } else {
                header('Location: ../index.php');
                exit();
            }
        } else {
            header('Location: ../login.php?error');
            exit();
        }
    } else {
        header('Location: ../login.php');
    }
}