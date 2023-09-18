<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Danh Sách Sản Phẩm
            <a href="./index.php?pages=product&action=add" class="btn btn-danger float-end"><i class="fas fa-plus"></i></a>
        </h4>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr class="font-weight-bolder">
                        <td>ID</td>
                        <td>Tên Khóa Học</td>
                        <td>Hình Ảnh</td>
                        <td>Giá</td>
                        <td>Mô Tả</td>
                        <td>Phân loại</td>
                        <td>Tùy Chọn</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>