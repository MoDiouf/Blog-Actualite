<?php
require_once __DIR__ . '/config/database.php';


$sqlCategorie = $pdo->query("SELECT * FROM Categorie ORDER BY libelle");
$categories = $sqlCategorie->fetchAll(PDO::FETCH_ASSOC);

$categorie = isset($_GET["categorie"]) ? intval($_GET["categorie"]) : 0;


if ($categorie == 0) {
    $sql = $pdo->prepare("
        SELECT Article.*, Categorie.libelle
        FROM Article
        JOIN Categorie
            ON Article.categorie = Categorie.id
        ORDER BY dateCreation DESC
    ");

    $sql->execute();
} else {
    $sql = $pdo->prepare("
        SELECT Article.*, Categorie.libelle
        FROM Article
        JOIN Categorie
            ON Article.categorie = Categorie.id
        WHERE categorie = ?
        ORDER BY dateCreation DESC
    ");

    $sql->execute([$categorie]);
}

$articles = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MGLSI NEWS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/headers.php'; ?>

    <main>
        <?php if (count($articles) === 0): ?>
            <h2>Aucun article trouvé.</h2>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
                <article class="article">
                    <h2>
                        <a href="article.php?id=<?= $article['id'] ?>">
                            <?= htmlspecialchars($article['titre']) ?>
                        </a>
                    </h2>
                    
                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($article['libelle']) ?></p>
                    <p><strong>Date :</strong> <?= htmlspecialchars($article['dateCreation']) ?></p>
                    
                    <p><?= htmlspecialchars(substr($article['contenu'], 0, 200)) ?>...</p>
                    
                    <p>
                        <a href="article.php?id=<?= $article['id'] ?>">Lire la suite</a>
                    </p>
                    <hr>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>
