<?php
require_once "./controller/StudentController.php";

$controller = new StudentController();
$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'list':
    default:
        $controller->index();
        break;
}
?>
