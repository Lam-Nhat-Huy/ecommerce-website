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
    $query = loginAdmin($email, $password);
}


setCookies();
