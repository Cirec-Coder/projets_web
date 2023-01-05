<?php ob_start(); ?>


<?php

$titre = "Cinema - Liste des Acteurs";

$titre_secondaire = "Liste des Acteurs";
if ($listActeurs->rowCount() > 0) {
    $acteurs = $listActeurs->fetchAll();
    foreach ($acteurs as $acteur) {
        $d = new DateTime($acteur['date_acteur']);
        $dateAnn = $d->format('d-m-Y');
        $age = $d->diff(new DateTime())->y;
?>

        <div class="card">
            <figure>
                <img src="public/img/<?= $acteur['photo'] ?>" alt="photo de l'acteur  <?= $acteur['nom_acteur'] ?>">
            </figure>
            <div class="floating">

                <span class="act"><a href="index.php?action=showFilmo&id=<?= $acteur['id_acteur'] ?>"><b><?= $acteur['full_name'] ?></b></a></span>
                <span class="date"><?= "<b>Né le :</b> $dateAnn" ?></span><br>
                <span class="age"><?= "<b>Age :</b> $age" ?> <b>ans</b></span><br>
            </div>
            <a href="index.php?action=deleteActeur&id=<?= $acteur['id_acteur'] ?>" class="button" id="delete-btn" title="Supprime l'Acteur et tous ses &quot;Castings&quot; de la base !"><i class="fa-solid fa-xmark"></i></a>
        </div>

    <?php
    }
    ?>

<?php
} else {
    echo "Pas d'Acteur dans la base \n Il faut en ajouter un.";
}
$contenu = ob_get_clean();

require "view/template.php";

?>