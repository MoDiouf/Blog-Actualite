<?php

class ArticleController
{
    private PDO $pdo;
    private Article $articleModel;
    private Categorie $categorieModel;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->articleModel = new Article($pdo);
        $this->categorieModel = new Categorie($pdo);
    }

    public function index($categorie = 0)
    {
        $categories = $this->categorieModel->getAll();

        if ($categorie > 0) {
            $articles = $this->articleModel->getByCategorie($categorie);
        } else {
            $articles = $this->articleModel->getAll();
        }

        require __DIR__ . '/../views/index.php';
    }

    public function show($id)
    {
        $article = $this->articleModel->getById($id);

        if (!$article) {
            die("Article introuvable.");
        }

        require __DIR__ . '/../views/article.php';
    }
}