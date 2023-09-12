<?php
require_once './config/database.php';
require_once './admin/core/function.php';

if (isset($_POST['signup-admin'])) {
    $error = "";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    // Hàm dùng để redex name
    if (empty($username) || !preg_match('/^[a-zA-Z ]+$/', $username)) {
        $error .= "Please enter a valid name <br>";
    }
    // Hàm dùng để redex email
    if (empty($email) || !preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/', $email)) {
        $error .= "Please enter a valid email address <br>";
    }
    // Hàm kiểm tra nhập lại mật khẩu
    if ($password !== $cpassword) {
        $error .= "Password do not match <br>";
    }
    // Mật khẩu ít nhất phải trên 6 kí tự
    if (strlen($password) < 4) {
        $error .= "Password must be atleast 4 characters long <br>";
    }
    // Kiểm tra trùng lặp email
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
    if (mysqli_num_rows($checkEmailResult) > 0) {
        $error .= "Email already exists <br>";
    }
    // Run
    if ($error == "") {
        $sql = "INSERT INTO users (username, email, password, role_id) VALUES ('$username', '$email', '$password', '$role_id')";
        $query = mysqli_query($conn, $sql);
        header("Location: ./index.php?pages=login");
    } else {
        header("Location: ./index.php?pages=register");
    }
    // Lưu chữ thông tin lỗi
    $_SESSION['error'] = $error;
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
