<!-- 
    Mise à jour en temps réel des informations
    contenue dans l'iframe
 -->
<?php
session_start();
include 'asset/populate.php';
// Affiche la liste des joueurs d'un équipe selectionée
if (isset($_SESSION['club']) and !empty($_SESSION['club'] )) {
    foreach ($countries as $key => $value) {
        if ($_SESSION['countryName'] == $value->getName()) {
            foreach ($value->getClubs() as $key => $club) {
                if ($club->getName() == $_SESSION['club']) {
                    echo $club->listPlayer();
                }
            }
        }
    }
    die();
}
// Affiche la carièrre du joueur sélectionné
elseif (isset($_SESSION['player']) and !empty($_SESSION['player'] )) {
// var_dump($_SESSION);
    foreach ($countries as $key => $value) {
        if ($_SESSION['countryName'] == $value->getName()) {
            foreach ($value->getClubs() as $key => $club) {
                if ($club->getName() == $_SESSION['clubName']) {
                    foreach ($club->getPlayers() as $key => $player) {
                        if ($player->getName() == $_SESSION['player']) {
                            echo $player->listAllClubs();
                        }
                        
                    }
                    
                }
            }
        }
    }
    die();
}
// Affiche les Clubs du pays sélectioné
elseif (isset($_SESSION['countryName'])) {
    foreach ($countries as $key => $value) {
        if ($_SESSION['countryName'] == $value->getName()) {
            echo $value->listClub();
        }
    }
}
?>