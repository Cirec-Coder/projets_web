<!-- 
    portion de code qui représente le header
    ces portion de code "header.php & footer.php" sont réutilisable
    à souhait et du coup évite la réécriture du code 
    il suffit de faire appel à ces fichiers en lieux et place 
    par un :
    include 'view/header.php';
    entouré des balises php.
 -->
<?php
    // si on se trouve sur l'index alors la commande ("le lien") est vide et on affiche rien
    $href = (basename($_SERVER["PHP_SELF"]) == "index.php") ? "" :"javascript:history.back();" ;
    $title = (str_contains($href, "javascript")) ?"Retour à l'acceuil" :"";
?>
<header>
    <figure>
        <img src="img/stars2.png" alt="">
    </figure>
    <div>
    <h1>Reservation Hotel</h1>
    <h5>Liste Hotels.</h5>
    </div>
    <nav>
        <ul>
            <li id="menu"><a href=<?= $href ?>><?= $title ?></a></li>
        </ul>
    </nav>
</header>