<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Danh Sách Nhân Viên
            <a href="./index.php?pages=employee&action=add" class="btn btn-danger float-end"><i class="fas fa-plus"></i></a>
        </h4>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr class="font-weight-bolder">
                        <td>ID</td>
                        <td>Tên Nhân Viên</td>
                        <td>Giới Tính</td>
                        <td>Hình Ảnh</td>
                        <td>Email</td>
                        <td>Số Điện Thoại</td>
                        <td>Căn Cước</td>
                        <td>Địa Chỉ</td>
                        <td>Tùy Chọn</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    paginationEmployee();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>