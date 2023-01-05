<?php

use App\Session;

$posts = $result["data"]['posts'];
$title = $result["data"]['title'];
$subTitle = $result["data"]['subTitle'];

$currentUser = Session::getUser();
$isAdmin = Session::isAdmin();

?>
<div class="cards" id="title-cards">
    <div class="title" id="title-div">
    </div>
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>

<div class="post-container">
        <?php
        if (isset($posts)) {

            foreach ($posts as $post) :
                $topic = $post->getTopic();
                $isClosed = $topic->getClosed();
                $topicId = $topic->getId();
                $grayed = ($isClosed) ? " grayed" : "";
        ?>

                <div class="cards msg-cards<?= $grayed ?>">
                    <div class="msg-header">
                        <?php
                        // si le User est Admin ou l'auteur du message alors on affiche le panneau de controle
                        if ($isAdmin or (!$isClosed && $currentUser && $currentUser->getPseudo() == $post->getUser()->getPseudo())) {
                        ?>
                            <div class="floating post-admin-board">
                                <form action="index.php?ctrl=forum&action=modifyPostForm&id=<?= $post->getId() ?>" method="post">
                                    <input type="hidden" name="idtopic" value=<?= $topicId ?>>
                                    <input type="hidden" name="idpost" value=<?= $post->getId() ?>>
                                    <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                                    <button class="admin-board-btn edit-btn" type="submit" title="Modifier le message"><img class="board-img" src="public/img/edit.png" alt="edit image"></button>
                                </form>

                                <form action="index.php?ctrl=forum&action=deletePost" method="post">
                                    <input type="hidden" name="idtopic" value=<?= $topicId ?>>
                                    <input type="hidden" name="idpost" value=<?= $post->getId() ?>>
                                    <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                                    <button class="admin-board-btn delete-btn" type="submit" title="Supprimer le message"><img class="board-img" src="public/img/Annuler.png" alt="delete image"></button>
                                </form>
                            </div>
                        <?php
                        }
                        ?>
                        <p><strong>Posté le :</strong> <?= $post->getCreationdate("d-m-Y à H:i") ?> <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topicId ?>"> &emsp;  &emsp; <span><strong>Sujet : </strong><?= $topic->getTitle() ?></span></a> </p>
                    </div>
                    <div class="msg-main">
                        <div class="msg-user">
                            <p><strong> auteur :</strong> <?= $post->getUser()->getPseudo() ?></p>
                            <p><strong>status :</strong> <?= $post->getUser()->getFrendlyRoleName() ?></p>
                            <p><strong>date d'incription :</strong> <?= $post->getUser()->getInscriptiondate("d-m-Y") ?></p>
                            <p><strong>email :</strong> <?= $post->getUser()->getEmail() ?></p>
                        </div>
                        <div class="msg-msg">
                            <p>
                                <?= $post->getMessage() ?>
                            </p>
                        </div>
                    </div>
                    <div class="msg-footer">

                    </div>
                </div>
        <?php
            endforeach;
        }

        ?>
    </div>
</div>
<?php
