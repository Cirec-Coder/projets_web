<?php ob_start(); ?>


<?php

# code...
$titre = "Cinema - Liste des Acteurs";

$titre_secondaire = "Liste des Acteurs";
if ($listRealisateurs->rowCount() > 0) {
    $realisateurs = $listRealisateurs->fetchAll();
    // var_dump($realisateurs);
    // $titre_secondaire = "Casting du Film ".$realisateurs[0]['titre_film'];
    foreach ($realisateurs as $realisateur) :
        $d = new DateTime($realisateur['date_realisateur']);
        $dateAnn = $d->format('d-m-Y');
        $age = $d->diff(new DateTime())->y;
?>

        <div class="card">
            <a href="index.php?action=showFilmo&id=<?= $realisateur['id_realisateur'] ?>">
                <figure>
                    <img src="public/img/<?= $realisateur['photo'] ?>" alt="photo de l'realisateur  <?= $realisateur['nom_realisateur'] ?>">
                    <!-- <figcaption><?= $realisateur['prenom_realisateur'] . " " . $realisateur['nom_realisateur'] ?></figcaption> -->
                </figure>
            <div class="floating">

                <!-- <div class="genre"><a href="index.php?action=realisateursByGenre&id=<?= $realisateur['id_genre'] ?>"><?= $realisateur['nom_genre'] ?></a></div> -->
                <span class="real"><b><?= $realisateur['full_name'] ?></b></span>
                <span class="date"><?= "<b>Né le :</b> $dateAnn" ?></span><br>
                <span class="age"><?= "<b>Age :</b> $age" ?> <b>ans</b></span><br>
            </div>
            <a href="index.php?action=deleteReal&id=<?= $realisateur['id_realisateur'] ?>" class="button" id="delete-btn" title="Supprime le Réalisateur de la base de données&NewLine; ainsi que tous ses films et tous les &quot;Castings&quot; ascociés aux films !"><i class="fa-solid fa-xmark"></i></a>
            </a>
        </div>

    <?php
    endforeach;
    ?>

<?php
} else {
    echo "Pas d'Acteur dans la base \n Il faut en ajouter un.";
}
$contenu = ob_get_clean();

require "view/template.php";

?>