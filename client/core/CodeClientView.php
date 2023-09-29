<?php
if (isset($_POST['comment'])) {
    $comment = $_POST['comments'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    commentProduct($comment, $user_id, $product_id);
}
