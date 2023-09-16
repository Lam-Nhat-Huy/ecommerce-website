<?php


if (isset($_POST['signup-admin'])) {
    $username = sanitize_input($conn, $_POST['username']);
    $email = sanitize_input($conn, $_POST['email']);
    $password = sanitize_input($conn, $_POST['password']);
    $role_id = sanitize_input($conn, $_POST['role_id']);
    $cpassword = sanitize_input($conn, $_POST['cpassword']);
    $query = registerAdmin($username, $email, $password, $role_id, $cpassword);
}

if (isset($_POST['login-admin'])) {
    $email = sanitize_input($conn, $_POST['email']);
    $password = sanitize_input($conn, $_POST['password']);
    $query = loginAdmin($email, $password);
}

setCookies();
