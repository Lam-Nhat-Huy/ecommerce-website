<?php
// Thêm khóa học
if (isset($_POST['addProduct'])) {
    $name =  mysqli_real_escape_string($conn, $_POST['name']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $price =  mysqli_real_escape_string($conn, $_POST['price']);

    $description =  mysqli_real_escape_string($conn, $_POST['description']);
    $category_id =  mysqli_real_escape_string($conn, $_POST['category_id']);

    $targetDirectory = "./admin/upload/"; // Thay đổi đường dẫn tùy theo thư mục lưu trữ của bạn

    $targetPath = $targetDirectory . $image;
    move_uploaded_file($image_tmp, $targetPath);
    createNewProduct($name, $image, $price, $description, $category_id);
}

if (isset($_POST['updateProduct'])) {
    $product_id =  mysqli_real_escape_string($conn, $_POST['product_id']);
    $name =  mysqli_real_escape_string($conn, $_POST['name']);
    $price =  mysqli_real_escape_string($conn, $_POST['price']);
    $description =  mysqli_real_escape_string($conn, $_POST['description']);
    $category_id =  mysqli_real_escape_string($conn, $_POST['category_id']);

    // Kiểm tra xem người dùng có tải lên hình ảnh mới không
    if (!empty($_FILES['image']['name'])) {
        $image =  mysqli_real_escape_string($conn, $_FILES['image']['name']);
        // Di chuyển hình ảnh đã tải lên vào thư mục đích
        move_uploaded_file($_FILES['image']['tmp_name'], "./admin/upload/" . $image);
    } else {
        // Nếu không có hình ảnh mới, sử dụng hình ảnh hiện tại
        $image = mysqli_real_escape_string($conn, $_POST['current_image']);
    }

    editCurrentProduct($name, $image, $price, $description, $category_id, $product_id);
}


if (isset($_POST['deteleProduct'])) {
    deleteCurrentProduct();
}

if (isset($_POST['addCategory'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_note = mysqli_real_escape_string($conn, $_POST['category_note']);
    createNewCategory($category_name, $category_note);
}

if (isset($_POST['updateCategory'])) {
    $category_id =  mysqli_real_escape_string($conn, $_POST['category_id']);
    $category_name =  mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_note =  mysqli_real_escape_string($conn, $_POST['category_note']);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $update_at = date('Y-m-d H:i:s');
    editCurrentCategory($category_name, $category_note, $category_id, $update_at);
}

if (isset($_POST['deleteCategory'])) {
    deleteCurrentCategory();
}


if (isset($_POST['addEmployee'])) {
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $targetDirectory = "./admin/upload/employee/";
    $targetPath = $targetDirectory . $image;
    move_uploaded_file($image_tmp, $targetPath);

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $cccd = mysqli_real_escape_string($conn, $_POST['cccd']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    addEmployee($image, $username, $email, $phone, $cccd, $address, $gender);
}

if (isset($_POST['updateEmployee'])) {
    $employee_id =  mysqli_real_escape_string($conn, $_POST['employee_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $cccd = mysqli_real_escape_string($conn, $_POST['cccd']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    // Kiểm tra xem người dùng có tải lên hình ảnh mới không
    if (!empty($_FILES['image']['name'])) {
        $image =  mysqli_real_escape_string($conn, $_FILES['image']['name']);
        // Di chuyển hình ảnh đã tải lên vào thư mục đích
        move_uploaded_file($_FILES['image']['tmp_name'], "./admin/upload/employee/" . $image);
    } else {
        // Nếu không có hình ảnh mới, sử dụng hình ảnh hiện tại
        $image = mysqli_real_escape_string($conn, $_POST['current_image']);
    }
    editEmployee($image, $username, $email, $phone, $cccd, $address, $gender, $employee_id);
}




if (isset($_POST['deleteEmployee'])) {
    deleteCurrentEmployee();
}
