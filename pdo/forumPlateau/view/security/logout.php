<?php
// devenu innutile
// $head = "<h1>se déconnecter</h1>";
$title = "se déconnecter";
?>
<div class="cards" id="title-cards">
        <form action="index.php?ctrl=security&action=logout" method="post" enctype="multipart">
            <button class="deco-btn" type="submit" name="logout">Déconnexion</button>
        </form>
</div>