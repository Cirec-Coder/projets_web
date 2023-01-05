<?php ob_start(); ?>

<?php

$titre = "Cinema - Ajouter un Genre";

$titre_secondaire = "Ajouter un Genre";
?>

<form class="form" action="index.php?action=addGenre" method="post">
    <label for="name">Nom Genre : </label>
    <input type="text" name="name" id="name">

    <button type="submit" name="action" class="action" value="AddGenre">Ajouter</button>

</form>
<?php
$contenu = ob_get_clean();

require "view/template.php";
?>