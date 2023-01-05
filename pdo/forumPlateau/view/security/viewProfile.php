<?php

use App\Session;
use Model\Managers\PostManager;


?>


<?php
// $user = Session::getUser();
$user = $result["data"]['user'];
$isOwner = $user->getId() == Session::getUser()->getId();
// $head = "<h1>Profile de " . Session::getUser()->getPseudo() . "</h1>";
// if (!$user) {
//     header('Location: index.php');
//     die();
// }
$postManager = new PostManager();
$title = "Profile de ";
$subTitle = $user->getPseudo();


?>
<div class="cards profile-div" id="msg-cards">
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
    <form action="index.php?ctrl=security&action=modifyPasswordForm" method="post">
        <h2>Informations Personnelles<small></small></h2>
        <p><strong>Pseudo : </strong> <?= $user->getPseudo() ?></p>
        <p><strong>Email : </strong> <?= $user->getEmail() ?></p>
        <p><strong>Date d'incription : </strong> <?= $user->getInscriptiondate() ?></p>
        <p><strong>Rôle : </strong> <?= $user->getFrendlyRoleName() ?></p>
        <a href="index.php?ctrl=forum&action=ListUserPosts&id=<?= $user->getId() ?>">
            <p><strong>Nombre de posts : </strong> <?= $postManager->countPostsByUserId($user->getId()) . " <strong>dans</strong> " . $postManager->countTopicsWithPostsByUserId($user->getId()) ?> <strong> sujets</strong> </p>
        </a>
        <?php if ($isOwner) { ?>
            <button class="submit-btn" type="submit"><i class="fa solid fa-key">&emsp;</i> Modifier le mot de passe</button>
        <?php } ?>
    </form>

    <?php if ($isOwner || Session::isAdmin()) { ?>
        <div class="floating post-admin-board user-admin-board">
            <form action="index.php?ctrl=security&action=deleteUser" method="post">
                <input type="hidden" name="userId" value=<?= $user->getId() ?>>
                <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                <button class="admin-board-btn delete-btn" type="submit" title="ATTENTION: cette action est irréversible"><img class="board-img" src="public/img/Annuler.png" alt="delete image"></button>
            </form>
        </div>
    <?php } ?>



</div>

<?php
?>