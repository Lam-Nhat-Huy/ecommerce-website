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

function getIdFromCurrentUrl()
{
    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    if (isset($query['id'])) {
        return $query['id'];
    } else {
        return 'Không tìm thấy ID trong URL';
    }
}

function createNewProduct($name, $image, $price, $description, $category_id)
{
    global $conn;
    if (!empty($name) or !empty($image) or !empty($price) or !empty($description) or !empty($category_id)) {
        $query_product = mysqli_query($conn, "INSERT INTO products (name, image, price, description, category_id) VALUES ('$name', '$image', '$price', '$description', '$category_id')");
        header('Location: /index.php?pages=product&action=list');
    } else {
        header('Location: /index.php?pages=product&action=add');
    }
}

function editCurrentProduct($name, $image, $price, $description, $category_id, $product_id)
{
    global $conn;
    $query_course = mysqli_query($conn, "UPDATE products SET `name`='$name',`image`='$image', `price`='$price', `description`='$description', `category_id` = '$category_id' WHERE id= $product_id");
    if ($query_course) {
        header('Location: /index.php?pages=product&action=list');
    }
}

function deleteCurrentProduct()
{
    global $conn;

    $product_id = mysqli_real_escape_string($conn, $_POST['deteleProduct']);

    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $query = "DELETE FROM products WHERE id = $product_id";
    $sql = mysqli_query($conn, $query);
    if ($sql) {
        header('Location: /index.php?pages=product&action=list');
    }
}

function displayCategoryView()
{
    global $conn;
    $select_category_id = mysqli_query($conn, "SELECT * FROM category");
    if (mysqli_num_rows($select_category_id) > 0) {
        while ($row = mysqli_fetch_array($select_category_id)) {
?>
            <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
<?php
        }
    }
}

function createNewCategory($category_name, $category_note)
{
    global $conn;
    $query_category = mysqli_query($conn, "INSERT INTO category (category_name, category_note) VALUES ('$category_name', '$category_note')");

    if ($query_category) {
        header("Location: /index.php?pages=category&action=list");
    } else {
        header("Location: /index.php?pages=category&action=add");
    }
}

function editCurrentCategory($category_name, $category_note, $category_id)
{
    global $conn;
    $query_course = mysqli_query($conn, "UPDATE category SET category_name='$category_name', category_note = '$category_note'  WHERE id= $category_id");
    if ($query_course) {
        header('Location: /index.php?pages=category&action=list');
    }
}

function deleteCurrentCategory()
{
    global $conn;
    $category_id = mysqli_real_escape_string($conn, $_POST['deleteCategory']);
    $query = "SELECT * FROM category WHERE id = $category_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $query = "DELETE FROM category WHERE id = $category_id";
    $sql = mysqli_query($conn, $query);
    if ($sql) {
        header('Location: /index.php?pages=category&action=list');
    }
}
