<nav>
    <a href="pagination.php">Accueil</a>
    <a href="upload.html">Postuler</a>
</nav>

<?php
require 'validate.php';


// Vérifier si un fichier a été téléversé
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    // Répertoire de destination
    $uploadDir = "uploads/";

    // Vérifier si le répertoire existe, sinon le créer
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Vérification des erreurs
    if ($file["error"] !== UPLOAD_ERR_OK) {
        echo "Erreur lors du téléversement du fichier.";
        exit;
    }

    // Vérification du type MIME
    $fileType = mime_content_type($file["tmp_name"]);
    if ($fileType !== "application/pdf") {
        echo "Seuls les fichiers PDF sont autorisés.";
        exit;
    }

    // Vérification de la taille (2 Mo max)
    $maxSize = 2 * 1024 * 1024; // 2 Mo
    if ($file["size"] > $maxSize) {
        echo "La taille du fichier dépasse la limite autorisée de 2 Mo.";
        exit;
    }

    // Sécurisation du nom du fichier
    $fileName = basename($file["name"]);
    $fileName = preg_replace("/[^A-Za-z0-9.\-_]/", "_", $fileName); // Remplacement des caractères spéciaux

    // Chemin de destination
    $destination = $uploadDir . $fileName;

    // Déplacement du fichier
    if (move_uploaded_file($file["tmp_name"], $destination)) {
        echo "Fichier téléversé avec succès : " . htmlspecialchars($fileName);
    } else {
        echo "Échec du téléversement du fichier.";
    }
} else {
    echo "Aucun fichier téléversé.";
}
?>
s