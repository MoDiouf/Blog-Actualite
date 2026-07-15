<?php
// Les données sont préparées par ArticleController
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