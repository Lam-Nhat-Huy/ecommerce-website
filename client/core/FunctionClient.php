<?php
function productList()
{
    global $conn;
    $checkProductQuery = "SELECT * FROM products";
    $checkProductResult = mysqli_query($conn, $checkProductQuery);
    if (mysqli_num_rows($checkProductResult)  > 0) {
        while ($row = mysqli_fetch_array($checkProductResult)) {
?>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="?pages=client&action=detail&id=<?= $row['id'] ?>">
                            <img src="../../../admin/upload/<?= $row['image'] ?>" alt="">
                        </a>
                    </div>
                    <h5><?= $row['name'] ?></h5>
                    <p class="product-price"><?= currency_format($row['price']) ?></p>
                    <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
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
            <div class="single-product mt-150 mb-150">
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
                                <p style="width: 400px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi
                                    cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi
                                    perferendis eos eum modi! Tempora, earum.</p>
                                <div class="single-product-form">
                                    <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                    <p><strong>Categories: </strong>Fruits, Organic</p>
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
