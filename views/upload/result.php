<?php require 'views/layouts/header.php'; ?>

<div class="result-container">
    <?php if (isset($error)): ?>
        <div class="error-message">
            <h2>Erreur</h2>
            <p><?php echo Validator::sanitizeInput($error); ?></p>
        </div>
    <?php else: ?>
        <div class="success-message">
            <h2>Succès!</h2>
            <p><?php echo Validator::sanitizeInput($message); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="navigation">
        <a href="index.php" class="button">Retour à l'accueil</a>
        <a href="index.php?action=upload" class="button">Nouvelle candidature</a>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>