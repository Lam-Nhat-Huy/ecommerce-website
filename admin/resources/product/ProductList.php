<?php include './admin/include/adminviews/header.php'; ?>


<?php include './admin/include/adminviews/sidebar.php'; ?>


<!-- Main wrapper -->
<div class="body-wrapper">
    <?php include './admin/include/adminviews/headerStart.php'; ?>
    <div class="container-fluid">
        <h4>
            Danh Sách Sản Phẩm
            <a href="./index.php?pages=product&action=add" class="btn btn-danger float-end">Thêm</a>
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
                    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita accusamus vero, aperiam officiis accusantium quisquam eius voluptates, atque corporis officia doloremque perspiciatis dolor nobis consequatur sapiente saepe esse veniam cumque!</h1>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include './admin/include/adminviews/footer.php'; ?>