<?php
// Les données sont préparées par AdminController
?>

<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<title>Article</title>

<style>

body{

    font-family:Arial;

    width:700px;

    margin:40px auto;

}

input,
textarea,
select{

    width:100%;

    padding:10px;

    margin-bottom:20px;

}

textarea{

    height:250px;

}

button{

    padding:10px 20px;

    background:#1f4e79;

    color:white;

    border:none;

    cursor:pointer;

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

<h1>

<?=

$mode=="ajout"

?

"Ajouter un article"

:

"Modifier un article"

?>

</h1>

<form method="post" action="../../index.php?action=admin_save">

<input
type="hidden"
name="id"
value="<?= $id ?>">

<label>

Titre

</label>

<input

type="text"

name="titre"

value="<?= htmlspecialchars($titre) ?>"

required

>

<label>

Catégorie

</label>

<select

name="categorie"

required

>

<?php

foreach($categories as $cat){

?>

<option

value="<?= $cat["id"] ?>"

<?=

$categorie==$cat["id"]

?

"selected"

:

""

?>

>

<?= $cat["libelle"] ?>

</option>

<?php

}

?>

</select>

<label>
Contenu
</label>

<textarea
name="contenu"
required
><?= htmlspecialchars($contenu) ?></textarea>

<button>
<?=
$mode=="ajout"
?
"Ajouter"
:
"Modifier"
?>
</button>

</form>

<br>

<a href="../../index.php?action=admin">
Retour
</a>

</body>

</html>