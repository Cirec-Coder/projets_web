<?php

$users = $result["data"]['users'];

?>

<div class="cards pseudo-div" id="title-cards">
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
    <?php
    // $head = "<h1>liste des Membres</h1>";
    $title = "liste des Membres";
    foreach ($users as $user) {

    ?>
        <a href="index.php?ctrl=security&action=profileForm&id=<?= $user->getId() ?>">
            <div class="cards pseudo-cards">
                <!-- <a href="index.php?ctrl=forum&action=listPosts&id=<?= $user->getPseudo() ?>"> -->
                <p><strong>Pseudo : </strong> <?= $user->getPseudo() ?></p>
                <p><strong>Date d'incription : </strong> <?= $user->getInscriptiondate("d-m-Y") ?></p>
                <!-- </a> -->
            </div>
        </a>
    <?php
    }
    ?>
</div>