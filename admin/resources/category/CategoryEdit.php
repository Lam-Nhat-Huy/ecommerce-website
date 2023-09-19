<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Chỉnh Sửa Sản Phẩm
            <a href="./index.php?pages=category&action=list" class="btn btn-danger float-end"><i class="fas fa-arrow-left"></i></a>
        </h4>
        <div class="card-body">
            <?php
            $category_id = mysqli_real_escape_string($conn, $_GET['id']);
            $select_category = mysqli_query($conn, "SELECT * FROM category WHERE id = $category_id");
            if (mysqli_num_rows($select_category) > 0) {
                while ($row = mysqli_fetch_array($select_category)) {
            ?>
                    <form action="./index.php?pages=execution-3" method="post">
                        <input type="hidden" name="category_id" value="<?= getIdFromCurrentUrl() ?>">

                        <div class="mb-3">
                            <label for="">Phân loại: </label>
                            <input type="text" class="form-control" name="category_name" value="<?= $row['category_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Ghi chú: </label>
                            <input type="text" class="form-control" name="category_note" value="<?= $row['category_note'] ?>">
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="updateCategory" class="btn btn-primary"><i class="fas fa-save"></i></button>
                        </div>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>