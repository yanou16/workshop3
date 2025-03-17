<?php
class Enterprise {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEnterprises($offset, $limit) {
        // For now, we'll keep the static data, but in a real application, 
        // this would be a database query
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

        $entreprises = [];
        for ($i = 1; $i <= 50; $i++) {
            $entreprises[] = [
                'nom' => $entrepriseNames[array_rand($entrepriseNames)] . " " . $i,
                'secteur' => $secteurs[array_rand($secteurs)],
                'ville' => $villes[array_rand($villes)]
            ];
        }

        return array_slice($entreprises, $offset, $limit);
    }

    public function getTotalCount() {
        return 50; // Static count for now
    }
}