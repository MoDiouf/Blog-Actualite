<?php
require_once __DIR__ . '/config/database.php';

// Récupération des catégories
$sqlCategorie = $pdo->query("SELECT * FROM Categorie ORDER BY libelle");
$categories = $sqlCategorie->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si une catégorie est sélectionnée
$categorie = isset($_GET["categorie"]) ? intval($_GET["categorie"]) : 0;

// Requête des articles
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
<header>
<h1>MGLSI NEWS</h1>
<nav>
<a href="index.php">Accueil</a>
<?php foreach ($categories as $cat) { ?>
<a href="accueil.php?categorie=<?= $cat["id"] ?>">
<?= $cat["libelle"] ?>
</a>
<?php } ?>
</nav>
</header>
<main>
<?php
if (count($articles) == 0) {
    echo "<h2>Aucun article trouvé.</h2>";
}
foreach ($articles as $article) { ?>
<div class="article">
<h2>
<a href="article.php?id=<?= $article["id"] ?>">
<?= $article["titre"] ?>
</a>
</h2>
<p>
<strong>Catégorie :</strong>
<?= $article["libelle"] ?>
</p>
<p>
<strong>Date :</strong>
<?= $article["dateCreation"] ?>

</p>

<p>

<?= substr($article["contenu"], 0, 200) ?>...

</p>

<p>

<a href="article.php?id=<?= $article["id"] ?>">

Lire la suite

</a>

</p>

<hr>

</div>

<?php }
?>

</main>

</body>

</html>