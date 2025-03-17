<?php require 'views/layouts/header.php'; ?>

<h1>Liste des entreprises partenaires</h1>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Secteur d'activité</th>
            <th>Ville</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($enterprises as $entreprise): ?>
            <tr>
                <td><?php echo Validator::sanitizeInput($entreprise['nom']); ?></td>
                <td><?php echo Validator::sanitizeInput($entreprise['secteur']); ?></td>
                <td><?php echo Validator::sanitizeInput($entreprise['ville']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="nav">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Précédent</a>
    <?php endif; ?>
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Suivant</a>
    <?php endif; ?>
</div>

<?php require 'views/layouts/footer.php'; ?>