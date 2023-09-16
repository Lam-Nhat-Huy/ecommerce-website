<?php
define('DB_HOST', 'localhost');
define('DB_ROOT', 'root');
define('DB_PASS', 'kalosonits14');
define('DB_NAME', 'beelab_db');

$conn = mysqli_connect(DB_HOST, DB_ROOT, DB_PASS, DB_NAME);

if (!$conn) {
    echo "Kết nối thất bại: " . mysqli_connect_error();
    exit();
}
