<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Danh Sách Sản Phẩm
            <a href="./index.php?pages=category&action=add" class="btn btn-danger float-end"><i class="fas fa-plus"></i></a>
        </h4>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr class="font-weight-bolder">
                        <td>ID</td>
                        <td>Thể loại</td>
                        <td>Ghi chú</td>
                        <td>Ngày tạo</td>
                        <td>Ngày sửa</td>
                        <td>Tùy Chọn</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_category = mysqli_query($conn, "SELECT * FROM category");
                    if (mysqli_num_rows($select_category) > 0) {
                        while ($row = mysqli_fetch_array($select_category)) {
                    ?>
                            <tr style="vertical-align: middle;">
                                <td>
                                    <?= $row['id'] ?>
                                </td>
                                <td>
                                    <?= $row['category_name'] ?>
                                </td>
                                <td class="text-success">
                                    <?= $row['category_note'] ?>
                                </td>
                                <td>
                                    <?= $row['create_at'] ?>
                                </td>
                                <td>
                                    <?= $row['update_at'] ?>
                                </td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="./index.php?pages=category&action=edit&id=<?= $row['id'] ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="./index.php?pages=execution-3" method="post">
                                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa? ')" type="submit" class="btn btn-danger" name="deleteCategory" value="<?= $row['id'] ?>"><i class="fas fa-trash-alt"></i>
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