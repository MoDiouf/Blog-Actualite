<?php

class AdminController
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

    public function index()
    {
        $articles = $this->articleModel->getAll();
        require __DIR__ . '/../views/admin/index.php';
    }

    public function form($id = 0)
    {
        $categories = $this->categorieModel->getAll();
        $mode = "ajout";
        $titre = "";
        $contenu = "";
        $categorie = "";

        if ($id > 0) {
            $mode = "modification";
            $article = $this->articleModel->getById($id);
            if ($article) {
                $titre = $article['titre'];
                $contenu = $article['contenu'];
                $categorie = $article['categorie'];
            }
        }

        require __DIR__ . '/../views/admin/formulaire.php';
    }

    public function save()
    {
        $titre = $_POST['titre'] ?? '';
        $contenu = $_POST['contenu'] ?? '';
        $categorie = $_POST['categorie'] ?? 0;
        $id = $_POST['id'] ?? 0;

        if (empty($titre) || empty($contenu) || empty($categorie)) {
            die("Tous les champs sont obligatoires.");
        }

        if ($id > 0) {
            $this->articleModel->update($id, $titre, $contenu, $categorie);
        } else {
            $this->articleModel->create($titre, $contenu, $categorie);
        }

        header('Location: ../index.php?action=admin');
        exit;
    }

    public function delete($id)
    {
        if ($id > 0) {
            $this->articleModel->delete($id);
        }

        header('Location: ../index.php?action=admin');
        exit;
    }
}
