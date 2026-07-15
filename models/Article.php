<?php

class Article
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "
            SELECT Article.*, Categorie.libelle
            FROM Article
            JOIN Categorie
            ON Article.categorie = Categorie.id
            ORDER BY dateCreation DESC
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategorie($id)
    {
        $sql = $this->pdo->prepare("
            SELECT Article.*, Categorie.libelle
            FROM Article
            JOIN Categorie
            ON Article.categorie = Categorie.id
            WHERE categorie=?
        ");

        $sql->execute([$id]);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = $this->pdo->prepare("
            SELECT Article.*, Categorie.libelle
            FROM Article
            JOIN Categorie
            ON Article.categorie = Categorie.id
            WHERE Article.id=?
        ");

        $sql->execute([$id]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function create($titre, $contenu, $categorie)
    {
        $sql = $this->pdo->prepare("
            INSERT INTO Article(titre,contenu,categorie)
            VALUES(?,?,?)
        ");

        return $sql->execute([
            $titre,
            $contenu,
            $categorie
        ]);
    }

    public function update($id, $titre, $contenu, $categorie)
    {
        $sql = $this->pdo->prepare("
            UPDATE Article
            SET
                titre=?,
                contenu=?,
                categorie=?,
                dateModification=NOW()
            WHERE id=?
        ");

        return $sql->execute([
            $titre,
            $contenu,
            $categorie,
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM Article WHERE id=?");

        return $sql->execute([$id]);
    }
}