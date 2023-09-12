<?php
session_start();

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
// hàm để hiển thị thông báo
function check_error()
{
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}
