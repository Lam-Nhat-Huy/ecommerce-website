<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Nhập Lương Nhân Viên
            <a href="./index.php?pages=product&action=list" class="btn btn-danger float-end"><i class="fas fa-arrow-left"></i></a>
        </h4>
        <form action="./index.php?pages=execution-3" method="post" enctype="multipart/form-data" class="needs-validation was-validated">
            <div class="col-md-12 mb-5">
                <label class="form-label">Tên nhân viên</label>
                <select class="form-select" name="employee_id" required aria-label=".form-select-sm example">
                    <?php
                    $checkEmployeeQuery = mysqli_query($conn, "SELECT * FROM employee");
                    if (mysqli_num_rows($checkEmployeeQuery) > 0) {
                        while ($row = mysqli_fetch_array($checkEmployeeQuery)) {
                    ?>
                            <option value="<?= $row['id'] ?>"><?= $row['username'] ?> </option>
                    <?php
                        }
                    }
                    ?>

                </select>
            </div>

            <div class="mb-3">
                <label for="salary">Lương nhân viên: </label>
                <input type="text" class="form-control" name="salary" required>
                <div class="invalid-feedback">
                    Lương không được để trống.
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" name="addSalary" class="btn btn-primary"><i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>