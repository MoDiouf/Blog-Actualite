<?php
// Les données sont préparées par ArticleController
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MGLSI NEWS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>MGLSI NEWS</h1>

        <nav>
            <a href="index.php">Accueil</a>

            <?php foreach ($categories as $cat): ?>
                <a href="index.php?categorie=<?= $cat['id'] ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>

    <main>
        <?php if (count($articles) === 0): ?>
            <h2>Aucun article trouvé.</h2>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
                <article class="article">
                    <h2>
                        <a href="index.php?action=article&id=<?= $article['id'] ?>">
                            <?= htmlspecialchars($article['titre']) ?>
                        </a>
                    </h2>
                    
                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($article['libelle']) ?></p>
                    <p><strong>Date :</strong> <?= htmlspecialchars($article['dateCreation']) ?></p>
                    
                    <p><?= htmlspecialchars(substr($article['contenu'], 0, 200)) ?>...</p>
                    
                    <p>
                        <a href="index.php?action=article&id=<?= $article['id'] ?>">Lire la suite</a>
                    </p>
                    <hr>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>
