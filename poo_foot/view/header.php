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
include 'asset/populate.php';
session_start();
    // si on se trouve sur l'index alors la commande ("le lien") est vide et on affiche rien
    $href = (basename($_SERVER["PHP_SELF"]) == "index.php") ? "" :"javascript:history.back();" ;
    $title = (str_contains($href, "javascript")) ?"Retour à l'acceuil" :"";
?>
<header>
    <figure>
        <img src=<?= "img/".$_SESSION['countryName'].".png"; ?> alt="">
    </figure>
    <div>
    <h1>Clubs de Foot</h1>
    <h3><?= $_SESSION['countryName']; ?></h3>
    <h2><?php echo $_SERVER['REMOTE_ADDR']; ?></h2>
    </div>
    <nav>
        <ul>
            <li id="menu"><a href=<?= $href ?>><?= $title ?></a></li>
        </ul>
    </nav>
</header>