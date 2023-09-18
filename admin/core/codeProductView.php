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
    CreateNewProduct($name, $image, $price, $description, $category_id);
}

if (isset($_POST['updateCourse'])) {
    $product_id =  mysqli_real_escape_string($conn, $_POST['product_id']);
    $name =  mysqli_real_escape_string($conn, $_POST['name']);
    $image =  mysqli_real_escape_string($conn, $_POST['image']);
    $price =  mysqli_real_escape_string($conn, $_POST['price']);
    $description =  mysqli_real_escape_string($conn, $_POST['description']);
    $category_id =  mysqli_real_escape_string($conn, $_POST['category_id']);
    $query_course = mysqli_query($conn, "UPDATE products SET `name`='$name',`image`='$image', `price`='$price', `description`='$description', `category_id` = '$category_id' WHERE id= $product_id");
    if ($query_course) {
        header('Location: /index.php?pages=product&action=list');
    }
}



if (isset($_POST['deleteCourse'])) {
    DeleteCurrentProduct();
}
