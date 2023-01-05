<?php

use App\Session;

// $head = "<h1>liste des posts</h1>";
$title = "liste des posts pour :";
$posts = $result["data"]['posts'];
$topic = $result["data"]['topic'];
$subTitle = $topic->getTitle();
// var_dump($topic);
if (!$topic) {
?>
    <div class="cards" id="msg-cards">
        <span>Le Topic demandé n'esiste plus</span>
        <a href="index.php?ctrl=forum&action=listTopics">
            <span>revenir à la liste des topic</span>
        </a>
    </div>
<?php
    // exit();
} else {
    # code...
    $currentUser = Session::getUser();
    $isOwner = ($currentUser && $currentUser->getPseudo() == ( ($topic->getUser()) ? $topic->getUser()->getPseudo() :" Annonyme" ));
    $isClosed = $topic->getClosed();
    $isAdmin = Session::isAdmin();
?>


    <?php
    $owner = ($isOwner) ? " owner" : "";
    $grayed = ($isClosed) ? " grayed" : "";
    ?>
    <div class="cards <?= $grayed ?>" id="title-cards">
        <div class="title" id="title-div">
            <span><strong>Sujet :</strong> <?= $topic->getTitle() ?></span>
            <span><strong>Date :</strong> <?= $topic->getCreationdate() ?></span>
            <span class="topic-author<?= $owner ?>">Auteur : <?= ($topic->getUser()) ? $topic->getUser()->getPseudo() :" Annonyme" ?></span>
        </div>
        <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
        <?php
        // $user = App\Session::getUser();

        if ($isClosed) {

        ?>
            <div class="floating-right">
                <img title="Le sujet est verrouillé" class="static-board-img" src="public/img/closed-topic-2.png" alt="add image">
                <span> Le sujet est verrouillé</span>
            </div>
        <?php
        }
        // si le User est Admin alors on affiche le panneau de controle
        if ($isAdmin) {
        ?>
            <div class="floating topic-admin-board">
                <form action="index.php?ctrl=forum&action=deleteTopic" method="post">
                    <input type="hidden" name="idtopic" value=<?= $topic->getId() ?>>
                    <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                    <!-- <button class="admin-board-btn delete-btn" type="submit" title="Supprime le Topic et tous les messages associés"><i class="fa fa-minus"></i></button> -->
                    <button class="admin-board-btn delete-btn" type="submit" title="Supprime le Topic et tous les messages associés"><img class="board-img" src="public/img/Annuler.png" alt="delete image"></button>
                </form>

                <form action="index.php?ctrl=forum&action=setTopicSatus" method="post">
                    <input type="hidden" name="idtopic" value=<?= $topic->getId() ?>>
                    <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                    <?php
                    if ($isClosed) {
                    ?>
                        <button class="admin-board-btn unlock-btn" type="submit" name="unlockTopic" title="Déverrouille le Topic"><img class="board-img" src="public/img/lock1-open.png" alt="lock open image"></button>

                    <?php
                    } else {
                    ?>
                        <button class="admin-board-btn lock-btn" type="submit" name="lockTopic" title="Verrouille le Topic"><img class="board-img" src="public/img/lock1.png" alt="lock image"></button>

                    <?php
                    }
                    ?>
                </form>
            </div>
        <?php
        }


        // si l'utilisateur est connecté alors on autorise l'ajout de Posts
        if ($currentUser) {
        ?>
            <div class="floating" id="add-post">
                <a href="index.php?ctrl=forum&action=addPostForm&id=<?= $topic->getId() ?>">
                    <img title="Ajouter un message" class="board-img" src="public/img/Ajouter.png" alt="add image">
                    <!-- <i title="Ajouter un message" class="fa fa-plus"></i> -->
                </a>
            </div>
        <?php
        }




        ?>
        <div class="post-container">
            <?php
            if (isset($posts)) {

                foreach ($posts as $post) :
            ?>

                    <div class="cards msg-cards">
                        <div class="msg-header">
                            <?php
                            // si le User est Admin ou l'auteur du message alors on affiche le panneau de controle
                            if ($isAdmin or (!$isClosed && $currentUser && $currentUser->getPseudo() == ( ($post->getUser()) ? $post->getUser()->getPseudo() :" Annonyme" ))) {
                            ?>
                                <div class="floating post-admin-board">
                                    <form action="index.php?ctrl=forum&action=modifyPostForm&id=<?= $post->getId() ?>" method="post">
                                        <input type="hidden" name="idtopic" value=<?= $topic->getId() ?>>
                                        <input type="hidden" name="idpost" value=<?= $post->getId() ?>>
                                        <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                                        <button class="admin-board-btn edit-btn" type="submit" title="Modifier le message"><img class="board-img" src="public/img/edit.png" alt="edit image"></button>
                                    </form>

                                    <form action="index.php?ctrl=forum&action=deletePost" method="post">
                                        <input type="hidden" name="idtopic" value=<?= $topic->getId() ?>>
                                        <input type="hidden" name="idpost" value=<?= $post->getId() ?>>
                                        <input type="hidden" name="csrfToken" value=<?= Session::getToken() ?>>
                                        <button class="admin-board-btn delete-btn" type="submit" title="Supprimer le message"><img class="board-img" src="public/img/Annuler.png" alt="delete image"></button>
                                    </form>
                                </div>
                            <?php
                            }
                            ?>
                            <p><strong>Posté le :</strong> <?= $post->getCreationdate("d-m-Y à H:i") ?></p>
                        </div>
                        <div class="msg-main">
                            <div class="msg-user">
                                <p><strong> auteur :</strong> <?= ($post->getUser()) ? $post->getUser()->getPseudo() :" Annonyme" ?></p>
                                <p><strong>status :</strong> <?= ($post->getUser()) ? $post->getUser()->getFrendlyRoleName() :" n/a"  ?></p>
                                <p><strong>date d'incription :</strong> <?= ($post->getUser()) ? $post->getUser()->getInscriptiondate("d-m-Y") :" n/a" ?></p>
                                <p><strong>email :</strong> <?= ($post->getUser()) ? $post->getUser()->getEmail() :" n/a"  ?></p>
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
}
