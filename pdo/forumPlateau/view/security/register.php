<?php

use App\Session;

// $head = "<h1>Form Connexion</h1>";
$title = "Form Inscription";
// App\Debug::debug($_POST);
?>
<div class="cards" id="msg-cards">
    <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
    <form action="index.php?ctrl=security&action=register" method="post" enctype="multipart">
        <h2>Formulaire d'inscription <small>Tous les champs sont requis</small></h2>
        <div class="group">
            <input type="text" name="pseudo" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Pseudo</label>
        </div>
        <!-- <input type="text" name="pseudo" placeholder="pseudo" required> -->
        <div class="group">
            <input type="text" name="email" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Email</label>
        </div>
        <!-- <input type="email" name="email" placeholder="email" required> -->
        <div class="group">
            <input type="password" name="password" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Password</label>
        </div>
        <!-- <input type="password" name="password" placeholder="password" required> -->
        <div class="group">
            <input type="password" name="confirmPassword" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Confirme Password</label>
        </div>
        <!-- <input type="password" name="confirmPassword" placeholder="confirm password" required> -->
        <input type="hidden" name="csrf_Token" value=<?= Session::getToken() ?>>
        <button class="submit-btn" type="submit">valider</button>
    </form>
</div>