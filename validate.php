<?php
function validateInput($data) {
    $data = trim($data); // Supprime les espaces inutiles
    $data = stripslashes($data); // Supprime les antislashes
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Protège contre XSS
    return $data;
}
?>
