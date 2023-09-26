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
        case 'execution-3':
            include './admin/core/codeProductView.php';
            break;
        case 'admin':
            switch ($_GET['action']) {
                case 'dashboard':
                    include './admin/resources/admin/Dashboard.php';
                    break;
                default:
                    include './admin/resources/admin/Dashboard.php';
                    break;
            }
            break;

        case 'product':
            switch ($_GET['action']) {
                case 'list':
                    include './admin/resources/product/ProductList.php';
                    break;
                case 'add':
                    include './admin/resources/product/ProductAdd.php';
                    break;
                case 'edit':
                    include './admin/resources/product/ProductEdit.php';
                    break;
                default:
                    include './admin/resources/product/ProductList.php';
                    break;
            }
            break;

        case 'category':
            switch ($_GET['action']) {
                case 'list':
                    include './admin/resources/category/CategoryList.php';
                    break;
                case 'add':
                    include './admin/resources/category/CategoryAdd.php';
                    break;
                case 'edit':
                    include './admin/resources/category/CategoryEdit.php';
                    break;
                default:
                    include './admin/resources/category/CategoryList.php';
                    break;
            }
            break;

        case 'employee':
            switch ($_GET['action']) {
                case 'list':
                    include './admin/resources/employee/EmployeeList.php';
                    break;
                case 'add':
                    include './admin/resources/employee/EmployeeAdd.php';
                    break;
                case 'edit':
                    include './admin/resources/employee/EmployeeEdit.php';
                    break;
                default:
                    include './admin/resources/employee/EmployeeList.php';
                    break;
            }
            break;

        case 'inventory':
            switch ($_GET['action']) {
                case 'add':
                    include './admin/resources/inventory/InventoryAdd.php';
                    break;
                case 'edit':
                    include './admin/resources/inventory/InventoryEdit.php';
                    break;
                default:
                    include './admin/resources/inventory/InventoryAdd.php';
                    break;
            }
            break;
    }
}
