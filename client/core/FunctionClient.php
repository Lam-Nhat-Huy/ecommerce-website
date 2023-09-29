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


function commentProduct($comment, $user_id, $product_id)
{
    global $conn;
    $checkCommentQuery = "INSERT INTO comment (comment , user_id, product_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($checkCommentQuery);

    $checkIdQuery = "SELECT * FROM products";
    $result = $conn->query($checkIdQuery);
    $row = $result->fetch_array();

    if ($stmt === false) {
        die('Errors' . $conn->error);
    } else {
        header('Location: ?pages=client&action=detail&id=' . $row['id'] . '&category_id=' . $row['category_id']);
    }
    $stmt->bind_param('sss', $comment, $user_id, $product_id);
    $checkCommentResult = $stmt->execute();
    if ($checkCommentResult) {
        return true;
    }
}


function getIdHidden()
{
    global $conn;
    $checkIdHiddenQuery = "SELECT u.id AS user_id, p.id product_id FROM users u, products p, comment c WHERE c.user_id = u.id AND c.product_id = p.id";
    $checkIdHiddenResult = $conn->query($checkIdHiddenQuery);
    $row = $checkIdHiddenResult->fetch_array();
    ?>
    <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
    <?php
}

function commentView()
{
    global $conn;
    $checkCommentQuery = "SELECT u.username AS username, c.comment AS comment FROM users u, comment c WHERE u.id = c.user_id ";
    $checkCommentResult = $conn->query($checkCommentQuery);
    if ($checkCommentResult->num_rows > 0) {
        while ($row = $checkCommentResult->fetch_array()) {
    ?>
            <div class="commented-section mt-2">
                <div class="d-flex flex-row align-items-center commented-user">
                    <h5 class="mr-2"><?= $row['username'] ?></h5><span class="dot mb-5"></span><span class="mb-3 ml-2">4 giờ trước</span>
                </div>
                <div class="comment-text-sm"><span><?= $row['comment'] ?></span></div>
            </div>
<?php
        }
    }
}
