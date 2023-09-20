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
                        <td>Trạng Thái</td>
                        <td>Phân loại</td>
                        <td>Tùy Chọn</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_product = mysqli_query($conn, "SELECT c.id, c.name, c.image, c.image, c.price, c.description, ct.category_name, ct.category_note
                     FROM products c, category ct WHERE c.category_id = ct.id");
                    if (mysqli_num_rows($query_product) >  0) {
                        while ($fetch_product = mysqli_fetch_assoc($query_product)) {
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
                                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa? ')" type="submit" class="btn btn-danger mb-1" name="deleteCourse" value="<?= $fetch_product['id'] ?>"><i class="fas fa-trash-alt"></i>
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