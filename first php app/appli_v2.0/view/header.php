<?php
    include 'helpers/functions.php';
    $pageName = (basename($_SERVER["PHP_SELF"]) == "index.php") ? "recap.php" :"index.php" ;
    $title = $pageName == "index.php" ?"Retour à l'acceuil" :"Afficher le Panier";
?>
<header>
    <figure>
        <img src="img/elan.png" alt="">
    </figure>
    <div>
    <h1>Élan de fruit</h1>
    <h5>Votre marché bio.</h5>
    </div>
    <nav>
        <ul>
            <li id="menu"><a href=<?= $pageName ?>><?= $title ?></a></li>
            <li> <small> <?= getNbArticle();   ?> produits dans le panier</small></li>
        </ul>
    </nav>
</header>