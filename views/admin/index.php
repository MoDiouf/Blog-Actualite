<?php
// Les données sont préparées par AdminController
?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Administration</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
    margin:40px;
}

h1{
    margin-bottom:20px;
}

table{

    width:100%;
    border-collapse:collapse;
    background:white;

}

th,td{

    border:1px solid #ddd;
    padding:10px;

}

th{

    background:#1f4e79;
    color:white;

}

a{

    text-decoration:none;

}

.btn{

    padding:8px 12px;
    color:white;
    border-radius:5px;

}

.add{
    color:black;
}

.edit{
    color:black;
}

.delete{
     color:black;
}

</style>

</head>

<body>

<header>
    <h1>MGLSI NEWS</h1>
    <nav>
        <a href="../../index.php">Accueil</a>
    </nav>
</header>
<h1>Administration des articles</h1>

<p>

<a class="btn add" href="../../index.php?action=admin_form">

Ajouter un article

</a>

&nbsp;

<a href="../../index.php">

Retour au site

</a>

</p>

<table>

<tr>

<th>ID</th>

<th>Titre</th>

<th>Catégorie</th>

<th>Date</th>

<th>Actions</th>

</tr>

<?php foreach($articles as $article){ ?>

<tr>

<td><?= $article["id"] ?></td>

<td><?= htmlspecialchars($article["titre"]) ?></td>

<td><?= htmlspecialchars($article["libelle"]) ?></td>

<td><?= $article["dateCreation"] ?></td>

<td>

<a
class="btn edit"
href="../../index.php?action=admin_form&id=<?= $article["id"] ?>">

Modifier

</a>

<a
class="btn delete"
href="../../index.php?action=admin_delete&id=<?= $article["id"] ?>"
onclick="return confirm('Supprimer cet article ?')">

Supprimer

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>