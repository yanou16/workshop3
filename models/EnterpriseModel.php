<?php
class EnterpriseModel {
    private $entrepriseNames = [
        "TechCorp", "AlphaCorp", "BetaSoft", "CyberSystems", "Innova", 
        "GlobalTech", "DataWorks", "FutureCorp", "NetSolutions", "VisionInc"
    ];
    
    private $secteurs = [
        "Technologie", "Finance", "Marketing", "Santé", "Education", 
        "Immobilier", "Industriel", "Consulting", "E-commerce", "Énergie"
    ];
    
    private $villes = [
        "Paris", "Londres", "Berlin", "New York", "Tokyo", 
        "Madrid", "Rome", "Toronto", "Sydney", "Moscou"
    ];

    public function getAllEnterprises() {
        $entreprises = [];
        for ($i = 1; $i <= 50; $i++) {
            $entreprises[] = [
                'nom' => $this->entrepriseNames[array_rand($this->entrepriseNames)] . " " . $i,
                'secteur' => $this->secteurs[array_rand($this->secteurs)],
                'ville' => $this->villes[array_rand($this->villes)]
            ];
        }
        return $entreprises;
    }

    public function getPaginatedEnterprises($page, $perPage) {
        $entreprises = $this->getAllEnterprises();
        $offset = ($page - 1) * $perPage;
        return array_slice($entreprises, $offset, $perPage);
    }
}