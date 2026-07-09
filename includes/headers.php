<header>
    <h1>MGLSI NEWS</h1>

    <nav>
        <a href="index.php">Accueil</a>

        <?php foreach ($categories as $cat) { ?>
            <a href="index.php?categorie=<?= $cat['id'] ?>">
                <?= htmlspecialchars($cat['libelle']) ?>
            </a>
        <?php } ?>
    </nav>
</header>