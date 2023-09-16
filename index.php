<?php
require_once './config/database.php';
require('./admin/core/function.php');

if (isset($_GET['pages'])) {
    switch ($_GET['pages']) {
        case 'login':
            include './admin/auth/login.admin.php';
            break;
        case 'register':
            include './admin/auth/register.admin.php';
            break;
        case 'execution':
            include './admin/core/codeLoginView.php';
            break;
        case 'execution-2':
            include './admin/core/codeAdminView.php';
            break;

        case 'admin':
            switch ($_GET['action']) {
                case 'dashboard':
                    include './admin/resources/admin/dashboard.php';
                    break;
                case 'ui-buttons':
                    include './admin/resources/admin/ui-buttons.php';
                    break;
                case 'list':
                    include './admin/resources/admin/list.php';
                    break;
                default:
                    include './admin/resources/admin/dashboard.php';
                    break;
            }
            break;

        case 'product':
            switch ($_GET['action']) {
                case 'list':
                    include './admin/resources/product/list.php';
                    break;
                case 'add':
                    include './admin/resources/product/add.php';
                    break;
                case 'edit':
                    include './admin/resources/product/edit.php';
                    break;
                default:
                    include './admin/resources/product/list.php';
                    break;
            }
            break;
    }
}
