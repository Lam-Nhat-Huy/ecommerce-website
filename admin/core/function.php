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

function sanitize_input($conn, $data)
{
    return trim(mysqli_real_escape_string($conn, $data));
}

function checkLoginSesstion()
{
    if (isset($_SESSION['user'])) {
        header("Location: ./index.php?pages=admin&action=dashboard");
    }
}



function  checkLogout()
{
    session_start();
    session_destroy();
    header("Location: ./index.php?pages=login");
}

function saveUser()
{
    global $conn;
    $id = $_SESSION['role_id'];
    $checkUserQuery = "SELECT * FROM users WHERE id = '$id'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);
    $fetchUser = mysqli_fetch_assoc($checkUserResult);
    echo $fetchUser['username'];
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
    if (empty($username)) {
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

function loginAdmin($email, $password)
{
    global $conn;
    $error = "";
    $checkLoginQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $checkLoginResult = mysqli_query($conn, $checkLoginQuery);

    if ($error == 0) {
        if (mysqli_num_rows($checkLoginResult) > 0) {
            $fetchAdmin = mysqli_fetch_assoc($checkLoginResult);
            $roleId = $fetchAdmin['role_id'];
            if ($roleId == 1) {
                $_SESSION['role_id'] = $fetchAdmin['id'];
                $_SESSION['user'] = "yes";
                header('Location: /index.php?pages=admin&action=dashboard');
            } else {
                header('Location: /index.php?pages=login');
            }
        } else {
            header('Location: /index.php?pages=login');
        }
    }
}

function setCookies()
{
    // lưu và set thời gian lưu thông tin trên thanh input
    setcookie('username', $_POST['username'], time() + 15, '/');
    setcookie('email', $_POST['email'], time() + 15, '/');
}

function currency_format($number, $suffix = 'đ')
{
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . "{$suffix}";
    }
}

function CreateNewProduct($name, $image, $price, $description, $category_id)
{
    global $conn;
    if (!empty($name) or !empty($image) or !empty($price) or !empty($description) or !empty($category_id)) {
        $query_course = mysqli_query($conn, "INSERT INTO products (name, image, price, description, category_id) VALUES ('$name', '$image', '$price', '$description', '$category_id')");
        header('Location: /index.php?pages=product&action=list');
    } else {
        header('Location: /index.php?pages=product&action=add');
    }
}

function productListViews()
{
    global $conn;
    $query_course = mysqli_query($conn, "SELECT c.id, c.name, c.image, c.image, c.price, c.description, ct.category_name
    FROM products c, category ct WHERE c.category_id = ct.id");
    if (mysqli_num_rows($query_course) >  0) {
        while ($fetch_course = mysqli_fetch_assoc($query_course)) {
?>
            <tr style="vertical-align: middle;">
                <td><?= $fetch_course['id'] ?></td>
                <td><?= $fetch_course['name'] ?></td>
                <td>
                    <img src="./admin/upload/<?= $fetch_course['image'] ?>" alt="" width="100px">
                </td>
                <td><?= currency_format($fetch_course['price']); ?></td>
                <td class="td-width"><?= $fetch_course['description'] ?></td>
                <td><?= $fetch_course['category_name'] ?></td>

                <td class="p-4">
                    <a href="./index.php?pages=product&action=edit&id=<?= $fetch_course['id'] ?>" class="btn btn-primary mb-1"><i class="fas fa-pencil-alt"></i>
                    </a>

                    <form action="./admin/core/CodeAdminLogin.php" method="post">
                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa? ')" type="submit" class="btn btn-danger mb-1" name="deleteCourse" value="<?= $fetch_course['id'] ?>"><i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

                </td>
            </tr>
<?php
        }
    }
}
