<?php

session_start();
include("database.php");

// 1. LOGOUT
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: register.php");
    exit;
}

// 2. LOGIN
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        header("Location: register.php?loginEmailError=" . urlencode("Email not found") . "&tab=login");
    } else if ($user['password'] !== $password) {
        header("Location: register.php?loginPassError=" . urlencode("Incorrect password") . "&tab=login");
    } else {
        $_SESSION['user_id'] = $user['id'];
        header("Location: movies.php");
    }
    exit;
}

// 3. SIGN UP
if (isset($_POST['register'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $res_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($res_check) > 0) {
        header("Location: register.php?tab=signup&signupEmailError=" . urlencode("Email already exists"));
        exit;
    }

    if (strlen($password) < 6) {
        header("Location: register.php?tab=signup&signupPassError=" . urlencode("Password must be at least 6 characters"));
        exit;
    }

    $sql_insert = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    if (mysqli_query($conn, $sql_insert)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        header("Location: movies.php");
    } else {
        header("Location: register.php?signupError=Registration failed&tab=signup");
    }
    exit;
}

header("Location: register.php");
exit;
?>
