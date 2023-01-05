<?php ob_start(); ?>

<?php

$titre = "Cinema - Ajouter un Acteur";

$titre_secondaire = "Ajouter un Acteur";
?>

<form class="form" enctype="multipart/form-data" action="index.php?action=addActeur" method="post">
    <label for="name">Nom : </label>
    <input type="text" name="name" id="name">

    <label for="fname">Prénom : </label>
    <input type="text" name="fname" id="fname">

    Envoyez la photo de l'acteur : <input name="photo" type="file" />

    <label for="date">Date de Naissance : </label>
    <input type="text" name="date" id="date">

    <div>
        <input type='radio' id='homme' name='sex' value=1 checked>
        <label for='homme'>Homme</label>
        <input type='radio' id='femme' name='sex' value=2>
        <label for='femme'>Femme</label>
    </div>

    <button type="submit" name="action" class="action" value="AddActeur">Ajouter</button>

</form>
<?php
$contenu = ob_get_clean();

require "view/template.php";
?>