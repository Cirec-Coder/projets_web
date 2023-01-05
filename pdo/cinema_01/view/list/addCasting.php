<?php ob_start(); ?>

<?php

$titre = "Cinema - Ajouter un Casting";

$titre_secondaire = "Ajouter un Casting";
?>

<form class="form" action="index.php?action=addCasting&id=<?=$id?>" method="post">
    <label for="acteur-select">Acteur : </label>
    <select name="selectActeur" id="acteur-select">
        <?php
        $ret = "";
        foreach ($listActeurs as $acteur) {
            $ret .= '<option value="' . $acteur['id_acteur'] . '">' . $acteur['prenom_acteur'] . " " . $acteur['nom_acteur'] . '</option>';
        }
        echo $ret;
        ?>
    </select>

    <button type="submit" name="action" class="action" value="AddCasting">Ajouter</button>


</form>
<?php
$contenu = ob_get_clean();

require "view/template.php";
?>