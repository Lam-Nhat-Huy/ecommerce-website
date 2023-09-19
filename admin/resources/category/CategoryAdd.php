<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Thêm danh mục sản phẩm
            <a href="./index.php?pages=category&action=list" class="btn btn-danger float-end"><i class="fas fa-arrow-left"></i></a>
        </h4>
        <div class="card-body">
            <form action="./index.php?pages=execution-3" method="post" class="needs-validation was-validated">
                <div class="mb-3">
                    <label for="">Phân loại: </label>
                    <input type="text" class="form-control" name="category_name" required>
                    <div class="invalid-feedback">
                        Phân loại không được để trống.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Ghi chú: </label>
                    <input type="text" class="form-control" name="category_note" required>
                    <div class="invalid-feedback">
                        Ghi chú không được để trống.
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" name="addCategory" class="btn btn-primary"><i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>