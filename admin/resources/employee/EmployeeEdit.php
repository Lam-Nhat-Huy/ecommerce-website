<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <div class="card-body">
            <section class="h-100">
                <div class="container-fluid h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <div class="card card-registration my-4">
                                <div class="row g-0">
                                    <div class="col-xl-6 d-none d-xl-block">
                                        <img src="../../../admin/public/images/TEELAB-2.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card-body p-md-5 text-black">
                                            <a href="./index.php?pages=employee&action=list" class="btn btn-danger float-end"><i class="fas fa-arrow-left"></i></a>
                                            <h3 class="mb-5 text-uppercase">Thêm Nhân Viên Mới</h3>
                                            <?php
                                            $employee_id = getIdFromCurrentUrl();
                                            $checkEmployeeQuery = "SELECT * FROM employee WHERE id = $employee_id";
                                            $checkEmployeeResult = $conn->query($checkEmployeeQuery);
                                            while ($fetch_employee = mysqli_fetch_array($checkEmployeeResult)) {
                                            ?>
                                                <form action="./index.php?pages=execution-3" method="post" enctype="multipart/form-data">
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label" for="form3Example97">Ảnh Nhân Viên</label>
                                                        <input type="file" id="form3Example97" class="form-control form-control-lg" name="image" />
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <div class="form-outline">
                                                                <label class="form-label" for="form3Example1m">Tên đầy đủ</label>
                                                                <input type="text" id="form3Example1m" class="form-control form-control-lg" name="username" value="<?= $fetch_employee['username'] ?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-outline mb-3">
                                                        <label class="form-label" for="form3Example97">Email</label>
                                                        <input type="email" id="form3Example97" class="form-control form-control-lg" name="email" value="<?= $fetch_employee['email'] ?>" />
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-outline">
                                                                <label class="form-label" for="form3Example1m1">Số điện thoại</label>
                                                                <input type="text" id="form3Example1m1" class="form-control form-control-lg" name="phone" value="<?= $fetch_employee['phone'] ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-outline">
                                                                <label class="form-label" for="form3Example1m1">Căn Cước Công Dân</label>
                                                                <input type="text" id="form3Example1m1" class="form-control form-control-lg" name="cccd" value="<?= $fetch_employee['cccd'] ?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-outline mb-3">
                                                        <label class="form-label" for="form3Example8">Địa chỉ</label>
                                                        <input type="text" id="form3Example8" class="form-control form-control-lg" name="address" value="<?= $fetch_employee['address'] ?>" />
                                                    </div>

                                                    <select class="form-control" name="gender">
                                                        <option value="Nam" <?= $fetch_employee['gender'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                                                        <option value="Nữ" <?= $fetch_employee['gender'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                                                        <option value="Khác" <?= $fetch_employee['gender'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                                                    </select>


                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" name="addEmployee" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                                    </div>

                                                </form>
                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>