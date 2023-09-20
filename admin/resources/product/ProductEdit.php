<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Chỉnh sửa sản phẩm
            <a href="./index.php?pages=product&action=list" class="btn btn-danger float-end"><i class="fas fa-arrow-left"></i></a>
        </h4>
        <div class="card-body">
            <?php
            $proudct_id = mysqli_real_escape_string($conn, $_GET['id']);
            $query = "SELECT * FROM products WHERE id = $proudct_id";
            $sql = mysqli_query($conn, $query);

            while ($select_product = mysqli_fetch_array($sql)) {
            ?>
                <form action="./index.php?pages=execution-3" method="post" enctype="multipart/form-data" class="needs-validation was-validated">
                    <input type="hidden" name="product_id" value="<?= getIdFromCurrentUrl() ?>">
                    <div class="mb-3">
                        <label for="">Tên sản phẩm: </label>
                        <input type="text" class="form-control" name="name" value="<?= $select_product['name'] ?>" required>
                        <div class="invalid-feedback">
                            Sản phẩm không được để trống.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Hình Ảnh: </label>
                        <input type="file" class="form-control" name="image" value="<?= $select_product['image'] ?>">
                        <div class="invalid-feedback">
                            Hình ảnh không được để trống.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Giá: </label>
                        <input type="number" min="0" class="form-control" name="price" value="<?= $select_product['price'] ?>" required>
                        <div class="invalid-feedback">
                            Giá không được để trống.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả: </label>
                        <input type="text" class="form-control" name="description" value="<?= $select_product['description'] ?>" required>
                        <div class="invalid-feedback">
                            Mô tả không được để trống.
                        </div>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label class="form-label">Thể loại</label>
                        <select class="form-select" name="category_id" required aria-label=".form-select-sm example">
                            <?php
                            DisplayCategoryView();
                            ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <button type="submit" name="editProduct" class="btn btn-primary"><i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>
            <?php
            }

            ?>
            </form>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>