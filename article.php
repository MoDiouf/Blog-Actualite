<?php
require_once __DIR__ . '/config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Article introuvable.");
}

$id = (int) $_GET['id'];

$sql = $pdo->prepare("
    SELECT
        Article.*,
        Categorie.libelle
    FROM Article
    JOIN Categorie
        ON Article.categorie = Categorie.id
    WHERE Article.id = ?
");

$sql->execute([$id]);

$article = $sql->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    die("Article introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['titre']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1><?= htmlspecialchars($article['titre']) ?></h1>

<p>
    <strong>Catégorie :</strong>
    <?= htmlspecialchars($article['libelle']) ?>
</p>

<p>
    <strong>Date :</strong>
    <?= $article['dateCreation'] ?>
</p>

<hr>

<p>
    <?= nl2br(htmlspecialchars($article['contenu'])) ?>
</p>

<br>

<a href="index.php">← Retour à l'accueil</a>

</body>
</html>