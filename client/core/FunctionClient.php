<?php
function productList()
{
    global $conn;
    $checkProductQuery = "SELECT * FROM products ";
    $checkProductResult = mysqli_query($conn, $checkProductQuery);
    if (mysqli_num_rows($checkProductResult)  > 0) {
        while ($row = mysqli_fetch_array($checkProductResult)) {
?>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="?pages=client&action=detail&id=<?= $row['id'] ?>&category_id=<?= $row['category_id'] ?>">
                            <img src="../../../admin/upload/<?= $row['image'] ?>" alt="">
                        </a>
                    </div>
                    <h5><?= $row['name'] ?></h5>
                    <p class="product-price"><?= currency_format($row['price']) ?></p>
                    <a href="" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
        <?php
        }
    }
}

function productDetail()
{
    global $conn;
    $product_id = getIdFromCurrentUrl();
    $checkDetailQuery = "SELECT * FROM products WHERE id = $product_id";
    $checkDetailResult = mysqli_query($conn, $checkDetailQuery);
    if (mysqli_num_rows($checkDetailResult) > 0) {
        while ($row = mysqli_fetch_array($checkDetailResult)) {
        ?>
            <!-- single product -->
            <div class="single-product mt-50 mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="single-product-img">
                                <img src="../../admin/upload/<?= $row['image'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="single-product-content">
                                <h3><?= $row['name'] ?></h3>
                                <p class="single-product-pricing"><?= currency_format($row['price']) ?></p>
                                <p style="width: 450px;"><?= $row['description'] ?></p>
                                <div class="single-product-form">
                                    <form action="" class="d-flex flex-column">
                                        <input type="number" placeholder="0">
                                        <a href="" class="cart-btn" style="width: 150px;"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                    </form>
                                    <p><strong>Từ khóa: </strong>Áo phông</p>
                                    <ul class="product-share">
                                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end single product -->
        <?php
        }
    }
}


function moreProduct()
{
    global $conn;
    $category_id =  $_GET['category_id'];

    // mai làm get id category
    $checkMoreQuery = "SELECT * FROM products p, category c WHERE p.category_id = c.id AND p.category_id = $category_id LIMIT 3";
    $checkMoreResult = $conn->query($checkMoreQuery);
    if ($checkMoreResult->num_rows > 0) {
        while ($row = $checkMoreResult->fetch_assoc()) {
        ?>
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="?pages=client&action=detail&id=<?= $row['id'] ?>&category_id=<?= $row['category_id'] ?>"><img src="../../admin/upload/<?= $row['image'] ?>" alt=""></a>
                    </div>
                    <h3><?= $row['name'] ?></h3>
                    <p class="product-price"><?= currency_format($row['price']) ?></p>
                    <a href="" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
<?php
        }
    }
}
