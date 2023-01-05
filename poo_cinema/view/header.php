<?php
    // si on se trouve sur l'index alors la commande ("le lien") est vide et on affiche rien
    $href = (basename($_SERVER["PHP_SELF"]) == "index.php") ? "recap.php?action=viewText" :"javascript:history.back();" ;
    $title = (str_contains($href, "javascript")) ?"Retour à l'acceuil" :"Voir l'énoncé de l'exercice";
?>
<header>
    <figure>
        <img src="img/stars2.png" alt="">
    </figure>
    <div>
    <h1>Cinéthèque</h1>
    <h5>Exercice POO Cinéma</h5>
    </div>
    <nav>
        <ul>
            <li id="menu"><a href=<?= $href ?>><?= $title ?></a></li>
        </ul>
    </nav>
</header>