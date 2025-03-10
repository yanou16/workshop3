

<?php
require 'validate.php';

// Listes de noms, secteurs et villes
$entrepriseNames = [
    "TechCorp", "AlphaCorp", "BetaSoft", "CyberSystems", "Innova", 
    "GlobalTech", "DataWorks", "FutureCorp", "NetSolutions", "VisionInc"
];

$secteurs = [
    "Technologie", "Finance", "Marketing", "Santé", "Education", 
    "Immobilier", "Industriel", "Consulting", "E-commerce", "Énergie"
];

$villes = [
    "Paris", "Londres", "Berlin", "New York", "Tokyo", 
    "Madrid", "Rome", "Toronto", "Sydney", "Moscou"
];

// Création d'un tableau de 50 entreprises partenaires avec des valeurs aléatoires
$entreprises = [];
for ($i = 1; $i <= 50; $i++) {
    $entreprises[] = [
        'nom'     => $entrepriseNames[array_rand($entrepriseNames)] . " " . $i,
        'secteur' => $secteurs[array_rand($secteurs)],
        'ville'   => $villes[array_rand($villes)]
    ];
}

// Récupérer et sécuriser la page courante depuis GET
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if (!filter_var($page, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
    $page = 1;
}

$entreprisesParPage = 10;
$totalEntreprises = count($entreprises);
$totalPages = ceil($totalEntreprises / $entreprisesParPage);

// Vérifier que la page demandée existe
if ($page > $totalPages) {
    $page = $totalPages;
}

// Découper le tableau avec array_slice
$offset = ($page - 1) * $entreprisesParPage;
$entreprisesPage = array_slice($entreprises, $offset, $entreprisesParPage);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pagination dynamique</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        nav {
            background-color: #333;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th {
            background: #333;
            color: #fff;
            padding: 10px;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        tbody tr:hover {
            background: #ececec;
        }
        .nav {
            margin-top: 20px;
            text-align: center;
        }
        .nav a {
            margin: 0 10px;
            text-decoration: none;
            padding: 8px 16px;
            background: #333;
            color: #fff;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        .nav a:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <nav>
        <a href="upload.php">Accueil</a>
        <a href="upload.html">Postuler</a>
    </nav>
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
            <?php foreach ($entreprisesPage as $entreprise): ?>
                <tr>
                    <td><?php echo htmlspecialchars($entreprise['nom']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['secteur']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['ville']); ?></td>
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
</body>
</html>