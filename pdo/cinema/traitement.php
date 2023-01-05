<?php
require_once("Debug.php"); //pour afficher les données 
    if (isset($_POST)) {
        // debug::debug($_POST);
        header("Location:recap.php/?action=search&q=".$_POST['q']);
        die();
    } else {
        header("Location:index.php");
    }
?>