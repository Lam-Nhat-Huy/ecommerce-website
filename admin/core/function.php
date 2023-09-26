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

function paginationProduct()
{
    global $conn;

    $result_per_page = 5;
    $sql = "SELECT c.id, c.name, c.image, c.image, c.price, c.description, ct.category_name, ct.category_note
    FROM products c, category ct WHERE c.category_id = ct.id";
    $result = mysqli_query($conn, $sql);
    $number_of_results =  mysqli_num_rows($result);

    if (!isset($_GET['id'])) {
        $page = 1;
    } else {
        $page = $_GET['id'];
    }

    $this_page_first_result = ($page - 1) * $result_per_page;

    $sql = "SELECT c.id, c.name, c.image, c.image, c.price, c.description, ct.category_name, ct.category_note
    FROM products c, category ct WHERE c.category_id = ct.id LIMIT " . $this_page_first_result . ',' . $result_per_page;
    $result = mysqli_query($conn, $sql);
    while ($fetch_product = mysqli_fetch_array($result)) {
?>
        <tr style="vertical-align: middle;">
            <td><?= $fetch_product['id'] ?></td>
            <td><?= $fetch_product['name'] ?></td>
            <td>
                <img src="./admin/upload/<?= $fetch_product['image'] ?>" alt="" width="100px">
            </td>
            <td class="text-danger"><?= currency_format($fetch_product['price']); ?></td>
            <td class="td-width text-success"><?= $fetch_product['category_note'] ?></td>
            <td><?= $fetch_product['category_name'] ?></td>

            <td class="p-4">
                <a href="./index.php?pages=product&action=edit&id=<?= $fetch_product['id'] ?>" class="btn btn-primary mb-1"><i class="fas fa-pencil-alt"></i>
                </a>

                <form action="./index.php?pages=execution-3" method="post">
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa? ')" type="submit" class="btn btn-danger mb-1" name="deteleProduct" value="<?= $fetch_product['id'] ?>"><i class="fas fa-trash-alt"></i>
                    </button>
                </form>

            </td>
        </tr>


    <?php
    }

    $number_of_pages = ceil($number_of_results / $result_per_page);

    echo '<div style="text-align: center;">';
    for ($i = 1; $i <= $number_of_pages; $i++) {
        echo '
                <a class="pageni-link" href="index.php?pages=product&action=list&id= ' . $i . '" style="display: inline-block; padding: 4px 10px; margin-right: 4px; border-radius: 5px; border: 1px solid #ddd; background-color: #f8f8f8; text-decoration: none; color: black;">' . $i . '</a>
            ';
    }
    echo '</div>';
}

function paginationEmployee()
{
    global $conn;

    $result_per_page = 4;
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
    $number_of_results =  mysqli_num_rows($result);

    if (!isset($_GET['id'])) {
        $page = 1;
    } else {
        $page = $_GET['id'];
    }

    $this_page_first_result = ($page - 1) * $result_per_page;

    $sql = "SELECT * FROM employee LIMIT " . $this_page_first_result . ',' . $result_per_page;
    $result = mysqli_query($conn, $sql);
    while ($fetch_employee = mysqli_fetch_array($result)) {
    ?>
        <tr style="vertical-align: middle;">
            <td><?= $fetch_employee['id'] ?></td>
            <td><?= $fetch_employee['username'] ?></td>
            <td><?= $fetch_employee['gender'] ?></td>
            <td>
                <img src="./admin/upload/employee/<?= $fetch_employee['image'] ?>" alt="" width="100px">
            </td>
            <td class="text-danger"><?= $fetch_employee['email']; ?></td>
            <td class="td-width text-success"><?= $fetch_employee['phone'] ?></td>
            <td><?= $fetch_employee['cccd'] ?></td>
            <td><?= $fetch_employee['address'] ?></td>

            <td class="p-4">
                <a href="./index.php?pages=employee&action=edit&id=<?= $fetch_employee['id'] ?>" class="btn btn-primary mb-1"><i class="fas fa-pencil-alt"></i>
                </a>

                <form action="./index.php?pages=execution-3" method="post">
                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa? ')" type="submit" class="btn btn-danger mb-1" name="deteleEmployee" value="<?= $fetch_employee['id'] ?>"><i class="fas fa-trash-alt"></i>
                    </button>
                </form>

            </td>
        </tr>


<?php
    }

    $number_of_pages = ceil($number_of_results / $result_per_page);

    echo '<div style="text-align: center;">';
    for ($i = 1; $i <= $number_of_pages; $i++) {
        echo '
                <a class="pageni-link" href="index.php?pages=employee&action=list&id= ' . $i . '" style="display: inline-block; padding: 4px 10px; margin-right: 4px; border-radius: 5px; border: 1px solid #ddd; background-color: #f8f8f8; text-decoration: none; color: black;">' . $i . '</a>
            ';
    }
    echo '</div>';
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

function editCurrentCategory($category_name, $category_note, $category_id, $update_at)
{
    global $conn;
    $query_course = mysqli_query($conn, "UPDATE category SET category_name='$category_name', category_note = '$category_note', update_at='$update_at'  WHERE id= $category_id");
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

function countProduct()
{
    global $conn;
    $checkProductQuery = "SELECT COUNT(*) FROM products";
    $checkProductResult = $conn->query($checkProductQuery);
    if (mysqli_num_rows($checkProductResult) > 0) {
        while ($row = mysqli_fetch_assoc($checkProductResult)) {
            echo $row['COUNT(*)'];
        }
    }
}


function countCategory()
{
    global $conn;
    $checkCategoryQuery = "SELECT COUNT(*) FROM category";
    $checkCategoryResult = $conn->query($checkCategoryQuery);
    if (mysqli_num_rows($checkCategoryResult) > 0) {
        while ($row = mysqli_fetch_assoc($checkCategoryResult)) {
            echo $row['COUNT(*)'];
        }
    }
}


function countEmployee()
{
    global $conn;
    $checkEmployeeQuery = "SELECT COUNT(*) FROM employee";
    $checkEmployeeResult = $conn->query($checkEmployeeQuery);
    if (mysqli_num_rows($checkEmployeeResult) > 0) {
        while ($row = mysqli_fetch_assoc($checkEmployeeResult)) {
            echo $row['COUNT(*)'];
        }
    }
}

function addEmployee($image, $username, $email, $phone, $cccd, $address, $gender)
{
    global $conn;

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("INSERT INTO employee (image, username, email, phone, cccd, address, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error: " . $conn->error);
    } else {
        header('Location: ./index.php?pages=employee&action=list');
    }
    $stmt->bind_param("sssssss", $image, $username, $email, $phone, $cccd, $address, $gender);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        echo "<script>alert('Thêm Nhân Viên Thành Công')</script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
