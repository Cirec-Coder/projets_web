<?php
// $head = "<h1>Ajoute un Topic au Forum</h1>";
$title = "Ajoute un Topic au Forum";
// App\Debug::debug($_POST);
?>
<div class="cards" id="msg-cards">
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
    <form action="index.php?ctrl=forum&action=addTopic" method="post" enctype="multipart">
        <h2>Ajouter un nouveau Topic<small></small></h2>
        <div class="group">
            <input type="text" name="title" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Title</label>
        </div>
        <div class="group">
            <textarea name="message" cols="100" rows="10" required></textarea>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Message</label>
        </div>
        <!-- <input type="text" name="title" placeholder="Title" required><br> -->
        <button class="submit-btn" type="submit">valider</button>
    </form>
</div>