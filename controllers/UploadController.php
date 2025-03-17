<?php
require_once 'models/UploadModel.php';
require_once 'utilities/Validator.php';

class UploadController {
    private $model;
    
    public function __construct() {
        $this->model = new UploadModel();
    }

    public function showForm() {
        require 'views/upload/form.php';
    }

    public function handleUpload() {
        try {
            if (!isset($_FILES["file"]) || !isset($_POST['name'])) {
                throw new Exception("Veuillez remplir tous les champs requis.");
            }

            $data = [
                'name' => Validator::sanitizeInput($_POST['name']),
                'email' => Validator::sanitizeInput($_POST['email']),
                'position' => Validator::sanitizeInput($_POST['position']),
                'message' => Validator::sanitizeInput($_POST['message'])
            ];

            $applicationData = $this->model->saveApplication($data, $_FILES["file"]);
            $message = "Candidature envoyée avec succès!";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        
        require 'views/upload/result.php';
    }
}