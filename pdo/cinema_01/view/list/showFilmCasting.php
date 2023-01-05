<?php ob_start(); ?>


<?php

$titre = "Cinema - Casting Film";

$titre_secondaire = "Casting du Film";
?>
<!-- Affiche un bouton pour ajouter un Casting -->
<div style='width:100%;text-align: center;'>
    <a href="index.php?action=addCasting&id=<?= $idFilm ?>">
        <i id='add-btn' class='fa-regular fa-square-plus' title="Ajouter un Casting"></i>
    </a>
</div>
<?php
if ($castings->rowCount() > 0) {
    $acteurs = $castings->fetchAll();
    $titre_secondaire = "Casting du Film : <u>" . $acteurs[0]['titre_film'] . "</u>";
    foreach ($acteurs as $acteur) :
        $d = new DateTime($acteur['date_acteur']);
        $dateAnn = $d->format('d-m-Y');
        $age = $d->diff(new DateTime())->y;
?>

        <div class="card">
            <a href="index.php?action=showActeurFilmo&id=<?= $acteur['id_acteur'] ?>">
                <figure>
                    <img src="public/img/<?= $acteur['photo'] ?>" alt="photo de l'acteur  <?= $acteur['nom_acteur'] ?>">
                </figure>
                <div class="floating">

                    <span class="act"><b><?= $acteur['full_name'] ?></b></span>
                    <span class="date"><?= "<b>Né le :</b> $dateAnn" ?></span><br>
                    <span class="age"><?= "<b>Age :</b> $age" ?> <b>ans</b></span><br>
                </div>
                <a href="index.php?action=deleteCastingActeur&id=<?= $acteur['id_acteur'] ?>&idF=<?= $acteur['id_film'] ?>" class="button" id="delete-btn" title="Supprime l'Acteur' de la base !"><i class="fa-solid fa-xmark"></i></a>
            </a>
        </div>

    <?php
    endforeach;
    ?>

<?php
} else {
    echo "Pas de Casting pour ce Film";
}
$contenu = ob_get_clean();

require "view/template.php";

?>