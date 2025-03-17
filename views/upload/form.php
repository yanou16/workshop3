<?php require 'views/layouts/header.php'; ?>

<div class="form-container">
    <h2>Postuler à un emploi</h2>
    <form action="index.php?action=upload" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Nom complet:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="position">Poste souhaité:</label>
            <select id="position" name="position" required>
                <option value="">Sélectionnez un poste</option>
                <option value="developer">Développeur</option>
                <option value="designer">Designer</option>
                <option value="manager">Manager</option>
                <option value="marketing">Marketing</option>
            </select>
        </div>

        <div class="form-group">
            <label for="cv">CV (PDF uniquement, max 2 Mo):</label>
            <input type="file" id="cv" name="file" accept="application/pdf" required>
        </div>

        <div class="form-group">
            <label for="message">Message de motivation:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>

        <button type="submit">Envoyer la candidature</button>
    </form>
</div>

<?php require 'views/layouts/footer.php'; ?>