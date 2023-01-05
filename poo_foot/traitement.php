<!-- 
     Mise à jour des variables "superglobale"
 -->
<?php
session_start();
    if (isset($_GET["country"])) {
            $_SESSION['countryName'] = $_GET["country"];
            $_SESSION['player'] = "";
            $_SESSION['clubName'] = "";
            $_SESSION['club'] = "";
        } else    
   if (isset($_GET["club"])) {
        $_SESSION['club'] = $_GET["club"];

        $_SESSION['clubName'] = $_GET["club"];
        $_SESSION['player'] = "";

   } else    
   if (isset($_GET["player"])) {
        $_SESSION['player'] = $_GET["player"];
        $_SESSION['club'] = "";

    }


   header("Location:index.php");
