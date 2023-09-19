<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Thêm Sản Phẩm
            <a href="./index.php?pages=product&action=list" class="btn btn-danger float-end"><i class="fas fa-arrow-left"></i></a>
        </h4>
        <form action="./index.php?pages=execution-3" method="post" enctype="multipart/form-data" class="needs-validation was-validated">
            <div class="mb-3">
                <label for="username">Tên Sản Phẩm: </label>
                <input type="text" class="form-control" name="name" required>
                <div class="invalid-feedback">
                    Sản phẩm không được để trống.
                </div>
            </div>
            <div class="mb-3">
                <label for="">Hình Ảnh: </label>
                <input type="file" class="form-control" name="image" required>
                <div class="invalid-feedback">
                    Hình ảnh không được để trống.
                </div>
            </div>
            <div class="mb-3">
                <label for="">Giá: </label>
                <input type="number" min="0" class="form-control" name="price" required>
                <div class="invalid-feedback">
                    Giá không không được để trống.
                </div>
            </div>
            <div class="mb-3">
                <label for="">Mô Tả: </label>
                <input type="text" class="form-control" name="description" required>
                <div class="invalid-feedback">
                    Mô tả không được để trống.
                </div>
                <div class="col-md-12 mb-5">
                    <label class="form-label">Thể loại</label>
                    <select class="form-select" name="category_id" required aria-label=".form-select-sm example">
                        <?php
                        $select_category_id = mysqli_query($conn, "SELECT * FROM category");
                        if (mysqli_num_rows($select_category_id) > 0) {
                            while ($row = mysqli_fetch_array($select_category_id)) {
                        ?>
                                <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?> </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" name="addProduct" class="btn btn-primary"><i class="fas fa-save"></i></button>
                </div>
        </form>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>