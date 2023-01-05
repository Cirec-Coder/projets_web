<?php ob_start(); ?>


<?php

$titre = "Cinema - Liste films";

$titre_secondaire = "Liste des films";
?>

<?php
foreach ($listFilms as $film) :

?>

    <div class="card">
        <a href="index.php?action=showFilmCasting&id=<?= $film['id_film'] ?>">
            <figure>
                <img src="public/img/<?= $film['affiche'] ?>" alt="Affiche du Film  <?= $film['titre_film'] ?>">
                <figcaption><b>Titre : </b><?= $film['titre_film'] ?></figcaption>
            </figure>
            <div class="floating">
                <a href="index.php?action=filmsByGenre&id=<?= $film['id_genre'] ?>"><div class="genre"><?= $film['nom_genre'] ?></div></a>
                <span class="date"><b>Sortie : </b><?= $film['date_sortie'] ?></span><br>
                <span class="real"><b>Réal&nbsp;:&nbsp;</b><a href="index.php?action=showFilmo&id=<?= $film['id_realisateur'] ?>"><?= $film['prenom_realisateur'] . "&nbsp;" . $film['nom_realisateur'] ?></a></span>
            </div>
            <a href="index.php?action=deleteFilm&id=<?= $film['id_film'] ?>" class="button" id="delete-btn" title="Supprime le Film de la base !"><i class="fa-solid fa-xmark"></i></a>
            <a href="index.php?action=modifyFilm&id=<?= $film['id_film'] ?>" class="button" id="modify-btn" title="Modifier le Film"><i class="fa-solid fa-pen"></i></a>
        </a>
    </div>

<?php
endforeach;

if (isset($actionName)) {
    $titre_secondaire = "Liste des films $actionName : ";
}

?>

<?php
$contenu = ob_get_clean();

require "view/template.php";

?>