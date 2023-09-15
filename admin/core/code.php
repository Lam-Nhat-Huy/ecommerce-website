<?php
require_once './config/database.php';
require_once './admin/core/function.php';

if (isset($_POST['signup-admin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $query = registerAdmin($username, $email, $password, $role_id, $cpassword);
}

if (isset($_POST['login-admin'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'");


    if ($error == 0) {
        if (mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            $role_id = $row['role_id'];
            if ($role_id == 1) {
                $_SESSION['user_id'] = $row['id'];
                header('Location: /index.php?pages=admin&action=dashboard');
                // header('Location: /index.php?pages=admin&action=dashboard');
            } else {
                header('Location: /index.php?pages=login');
            }
        } else {
            header('Location: ./index.php?pages=login');
        }
    }
}

// lưu và set thời gian lưu thông tin trên thanh input
setcookie('username', $_POST['username'], time() + 20, '/');
setcookie('email', $_POST['email'], time() + 20, '/');
