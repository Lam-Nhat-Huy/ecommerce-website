<?php
session_start();

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

// hàm để hiển thị thông báo
function check_error()
{
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}


function registerAdmin($username, $email, $password, $role_id, $cpassword)
{
    global $conn;
    $error = "";

    // Kiểm tra trùng lặp email
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);
    if ($checkEmailResult->num_rows > 0) {
        $error .= "Email already exists <br>";
    }
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

    if ($error == "") {
        $checkUserQuery = "INSERT INTO users (username, email, password, role_id) VALUES ('$username', '$email', '$password', '$role_id')";
        $checkUserQuery = mysqli_query($conn, $checkUserQuery);
        header("Location: ./index.php?pages=login");
    } else {
        header("Location: ./index.php?pages=register");
    }

    // Lưu chữ thông tin lỗi
    $_SESSION['error'] = $error;
}
