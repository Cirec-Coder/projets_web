<?php ob_start(); ?>


<?php

$titre = "Cinema - Liste films";
if ($filmoReal->rowCount() > 0) {
    $films = $filmoReal->fetchall();
    $titre_secondaire = "Filmographie de " . $films[0]['prenom_realisateur'] . " " . $films[0]['nom_realisateur'];
} else {
    $titre_secondaire = "Pas de filmographie disponble";
}

$d = new DateTime($films[0]['date_realisateur']);
$dateAnn = $d->format('d-m-Y');
$age = $d->diff(new DateTime())->y;

?>
<div class="card ucard">
    <figure>
        <img src="public/img/<?= $films[0]['photo'] ?>" alt="Photo réalisateur du Film " .<?= $films[0]['nom_realisateur'] ?>>
    </figure>
    <nav>
        <ul>
            <?php
            foreach ($films as $film) :

            ?>

                <li><span class="title"><a href="index.php?action=showFilm&id=<?= $film['id_film'] ?>"><?= $film['titre_film'] ?></a></span>
                    <span class="date-sortie"><?= $film['date_sortie'] ?></span>
                </li>


            <?php
            endforeach;
            ?>
        </ul>
    </nav>
    <div class="floating">
        <span class="act"><b><?= $film['prenom_realisateur'] . " " . $film['nom_realisateur'] ?></b></span>
        <span class="date"><?= "<b>Né le :</b> $dateAnn" ?></span><br>
        <span class="age"><?= "<b>Age :</b> $age" ?> <b>ans</b></span><br>
    </div>
    <a href="index.php?action=deleteReal&id=<?= $film['id_realisateur'] ?>" class="button" id="delete-btn" title="Supprime le Réalisateur de la base de données&NewLine; ainsi que tous ses films et tous les &quot;Castings&quot; ascociés aux films !"><i class="fa-solid fa-xmark"></i></a>
</div>

<?php
$contenu = ob_get_clean();

require "view/template.php";

?>