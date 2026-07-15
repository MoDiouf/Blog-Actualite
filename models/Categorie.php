<?php

class Categorie
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        return $this->pdo
            ->query("SELECT * FROM Categorie ORDER BY libelle")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}