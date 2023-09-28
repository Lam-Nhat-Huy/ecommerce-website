<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Sales Overview</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Yearly Breakup -->
                    <div class="card overflow-hidden">
                        <a href="./index.php?pages=product&action=list" class="text-count" style="color: #000;">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-9 fw-semibold">Số Lượng Sản Phẩm:</h5>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="fw-semibold mb-3">
                                            <?php
                                            countProduct();
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-12">
                    <!-- Yearly Breakup -->
                    <div class="card overflow-hidden">
                        <a href="./index.php?pages=category&action=list" class="text-count" style="color: #000;">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-9 fw-semibold"> Số Lượng Danh Mục:</h5>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="fw-semibold mb-3">
                                            <?php
                                            countCategory();
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-12">
                    <!-- Yearly Breakup -->
                    <div class="card overflow-hidden">
                        <a href="./index.php?pages=employee&action=list" class="text-count" style="color: #000;">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-9 fw-semibold">Số Lượng Nhân Viên:</h5>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="fw-semibold mb-3">
                                            <?php
                                            countEmployee();
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden">
                <a href="./index.php?pages=employees&action=list" class="text-count" style="color: #000;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Áo Phông:</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    <?php
                                    countProductTee();
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden">
                <a href="./index.php?pages=employees&action=list" class="text-count" style="color: #000;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Áo Polo:</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    <?php
                                    countProductPolo();
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Yearly Breakup -->
            <div class="card overflow-hidden">
                <a href="./index.php?pages=employees&action=list" class="text-count" style="color: #000;">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Áo Sơ Mi:</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">
                                    <?php
                                    countProductSomi();
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>