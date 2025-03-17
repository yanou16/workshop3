<?php
require_once 'controllers/EnterpriseController.php';
require_once 'controllers/UploadController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'upload':
        $controller = new UploadController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->handleUpload();
        } else {
            $controller->showForm();
        }
        break;
    
    case 'list':
    default:
        $controller = new EnterpriseController();
        $controller->index();
        break;
}