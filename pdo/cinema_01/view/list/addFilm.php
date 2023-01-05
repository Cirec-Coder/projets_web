<?php

use Controller\RealisateurController;
use Controller\GenreController;

ob_start(); ?>

<?php
spl_autoload_register(function ($class_name) {

    include $class_name . ".php";
});

$titre = "Cinema - Ajouter un Film";

$titre_secondaire = "Ajouter un Film";
?>

<form class="form" enctype="multipart/form-data" action="index.php?action=addFilm" method="post">
    <label for="title">Titre du Film : </label>
    <input type="text" name="title" id="title">

    <div class="awsome"> <i class="fa-regular fa-image"></i> <input name="affiche" type="file" /></div>

    <label for="note">Note : </label>
    <input type="number" name="note" id="note" max="5" min="0" value="1">

    <label for="genre-select">Genre : </label>
    <select name="selectGenre" id="genre-select">
        <?php
        $ret = "";
        foreach ($listGenre as $genre) {
            $ret .= '<option value="' . $genre['id_genre'] . '">' . $genre['prenom_genre'] . " " . $genre['nom_genre'] . '</option>';
        }
        echo $ret;
        ?>
    </select>

    <label for="date">Date de Sortie : </label>
    <input type="text" name="date" id="date">

    <label for="duree">Durée du Film : </label>
    <input type="number" name="duree" id="duree">

    <label for="synopsis">Synopsis : </label>
    <textarea name="synopsis" id="synopsis" cols="30" rows="10"></textarea>

    <label for="real-select">Réalisateur : </label>
    <select name="selectRealisateur" id="real-select">
        <?php
        $ret = "";
        foreach ($listRealisateurs as $realisateur) {
            $ret .= '<option value="' . $realisateur['id_realisateur'] . '">' . $realisateur['prenom_realisateur'] . " " . $realisateur['nom_realisateur'] . '</option>';
        }
        echo $ret;
        ?>
    </select>

    <button type="submit" name="action" class="action" value="AddFilm">Ajouter</button>

</form>
<?php
$contenu = ob_get_clean();

require "view/template.php";
?>