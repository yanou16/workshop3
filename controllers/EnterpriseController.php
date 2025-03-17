<?php
require_once 'models/EnterpriseModel.php';
require_once 'utilities/Validator.php';  // Add this line

class EnterpriseController {
    private $model;
    
    public function __construct() {
        $this->model = new EnterpriseModel();
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        
        $enterprises = $this->model->getPaginatedEnterprises($page, $perPage);
        $totalEntreprises = count($this->model->getAllEnterprises());
        $totalPages = ceil($totalEntreprises / $perPage);

        require 'views/enterprise/list.php';
    }
}