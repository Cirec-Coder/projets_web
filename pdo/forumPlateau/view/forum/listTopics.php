<?php

use App\Session;
use Model\Managers\PostManager;

$postManager = new PostManager();
// $nbCount = $postManager->countPosts(2);
// var_dump($nbCount);
$topics = $result["data"]['topics'];
$title = "liste des Sujets";

$nbTopics = $result["data"]['nbTopics'];
$currentUser = Session::getUser();
$isAdmin = Session::isAdmin();
?>


<div class="cards" id="title-cards">
    <div class="title" id="title-div">
        <span> <?= $nbTopics ?> <strong> Topics</strong></span>
    </div>
    <div class="post-container">
        <?php
        // $head = "<h1>liste des Sujets</h1>";
        foreach ($topics as $topic) {
            $isClosed = $topic->getClosed();
            $grayed = ($isClosed) ? " grayed" : "";

        ?>
            <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                <div class="cards topic-title <?= $grayed ?>">
                    <span><strong>&emsp;Titre : </strong><?= $topic->getTitle() ?></span>
                    <span style="float: right;"> &emsp; <?= $postManager->countPosts($topic->getId()) ?> Posts</span>
                    <span style="float: right;"><strong> Auteur : </strong><?= ($topic->getUser()) ? $topic->getUser()->getPseudo() :" Annonyme" ?> </span>

                </div>
            </a>
        <?php
        }
        ?>
        </a>
    </div>
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
    <?php

    // si l'utilisateur est connecté alors on autorise l'ajout de Topic
    if ($currentUser) {
    ?>
        <div class="floating" id="add-post">
            <!-- <div class="goBack" onclick="goBack();">Retour</div> -->
            <a href="index.php?ctrl=forum&action=addTopicForm">
                <img title="Ajouter un sujet" class="board-img" src="public/img/Ajouter.png" alt="add image">
            </a>
        </div>
    <?php
    }
    ?>
</div>
<!-- </div> -->