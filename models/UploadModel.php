<?php
class UploadModel {
    protected $uploadDir;
    protected $maxSize = 2097152; // 2 MB
    protected $isTest = false;

    public function __construct($uploadDir = "uploads/", $isTest = false) {
        $this->uploadDir = $uploadDir;
        $this->isTest = $isTest;
    }

    public function uploadFile($file) {
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        if ($file["error"] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur lors du téléversement du fichier.");
        }

        if ($file["size"] > $this->maxSize) {
            throw new Exception("La taille du fichier dépasse la limite autorisée");
        }

        $allowedTypes = ['application/pdf'];
        if (!in_array($file["type"], $allowedTypes)) {
            throw new Exception("Type de fichier non autorisé");
        }

        $fileName = basename($file["name"]);
        $fileName = preg_replace("/[^A-Za-z0-9.\-_]/", "_", $fileName);
        $destination = $this->uploadDir . $fileName;

        if ($this->isTest) {
            if (!copy($file["tmp_name"], $destination)) {
                throw new Exception("Échec du téléversement du fichier.");
            }
        } else {
            if (!move_uploaded_file($file["tmp_name"], $destination)) {
                throw new Exception("Échec du téléversement du fichier.");
            }
        }

        return $fileName;
    }
}