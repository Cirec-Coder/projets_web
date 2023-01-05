<?php

use App\Session;
use App\Debug;

// $head = "<h1>Formulaire de modification du mot de passe</h1>";
$title = "Formulaire de modification du mot de passe";
// Debug::debug($_SESSION);
?>
<div class="cards" id="msg-cards">
  <button class="fa-solid fa-arrow-left-long goBack-btn floating-back board-img" onclick="goBack();" title="Retour à la page précédente"></button>
  <form action="index.php?ctrl=security&action=modifyPassword" method="post" enctype="multipart">
    <h2>Modifier le mot de passe<small>Tous les champs sont requis</small></h2>
    <!-- <label >Modifier le mot de passe</label> -->
    <div class="group">
      <input type="password" name="actualPassword" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Actual Password</label>
    </div>
    <!-- <input type="password" name="actualPassword" placeholder="actual password" required> -->
    <div class="group">
      <input type="password" name="password" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>New Password</label>
    </div>
    <!-- <input type="password" name="password" placeholder="new password" required> -->
    <div class="group">
      <input type="password" name="confirmPassword" required>
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Confirm New Password</label>
    </div>
    <!-- <input type="password" name="confirmPassword" placeholder="confirm new password" required> -->
    <input type="hidden" name="csrf_Token" value=<?= Session::getToken() ?>>
    <button class="submit-btn" type="submit">valider</button>
  </form>
</div>