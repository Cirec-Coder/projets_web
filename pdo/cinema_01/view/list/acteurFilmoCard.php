<?php ob_start(); ?>


<?php

$titre = "Cinema - Liste Filmographie";
if ($filmoActeur->rowCount() > 0) {
    $films = $filmoActeur->fetchall();
    $titre_secondaire = "Filmographie de " . $films[0]['prenom_acteur'] . " " . $films[0]['nom_acteur'];
} else {
    $titre_secondaire = "Pas de filmographie disponble";
}

?>
<div class="card ucard">
    <figure>
        <img src="public/img/<?= $films[0]['photo'] ?>" alt="Photo acteur du Film " .<?= $films[0]['nom_acteur'] ?>>
    </figure>
    <nav>
        <ul>
            <?php
            foreach ($films as $film) :

            ?>

                <li><span class="title"><a href="index.php?action=showFilm&id=<?= $film['id_film'] ?>"><?= $film['titre_film'] ?></a></span>
                <span class="date-sortie"><?= $film['date_sortie'] ?></span></li>

            <?php
            endforeach;
            ?>
        </ul>
    </nav>
    <a href="index.php?action=deleteActeur&id=<?= $id ?>" class="button" id="delete-btn" title="Supprime le Acteur de la base de données&NewLine; ainsi que tous ses films et tous les &quot;Castings&quot; ascociés aux films !"><i class="fa-solid fa-xmark"></i></a>
</div>

<?php
$contenu = ob_get_clean();

require "view/template.php";

?>