<?php

use App\Session;

// $head = "<h1>Form Connexion</h1>";
$title = "Form Connexion";
$token = Session::getToken();
?>
<div class="cards" id="msg-cards">
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
    <form action="index.php?ctrl=security&action=login" method="post" enctype="multipart">
        <h2>Formulaire de connexion<small>Tous les champs sont requis</small></h2>
        <!-- <label >Formulaire de connexion tous les champs sont requis</label> -->
        <div class="group">
            <input type="text" name="pseudo" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Pseudo</label>
        </div>
        <!-- <input type="text" name="pseudo" placeholder="pseudo" required> -->
        <div class="group">
            <input type="password" name="password" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Password</label>
        </div>
        <!-- <input type="password" name="password" placeholder="password" required> -->
        <input type="hidden" name="csrf_Token" value=<?= $token ?>>
        <button class="submit-btn" type="submit">valider</button>
    </form>
</div>