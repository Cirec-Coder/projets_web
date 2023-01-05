<?php
require_once("lib/dbconnect.php"); //le fichier de connexion à la BDD
require_once("Debug.php"); //pour afficher les données 

function getDbFilms(){
    global $db;
    $filmsStatement = $db->prepare('SELECT f.titre_film, f.date_sortie, SEC_TO_TIME(`duree`*60) AS duree,
                                    CONCAT(r.prenom_realisateur, " ", r.nom_realisateur) AS Nom
                                    FROM films f, realisateurs r
                                    WHERE f.realisateur_id = r.id_realisateur');
    $filmsStatement->execute();
    return $filmsStatement->fetchAll();
}

function getFilmIfExists($title, $name)
{
    global $db;                                                   // , INSTR('$title', f.titre_film)
    $filmsStatement = $db->prepare("SELECT f.id_film, f.titre_film, f.date_sortie, SEC_TO_TIME(`duree`*60) AS duree,
                                    CONCAT(r.prenom_realisateur, ' ', r.nom_realisateur) AS Nom
                                    FROM films f, realisateurs r
                                    WHERE  f.titre_film LIKE '%$title%' AND r.nom_realisateur = '$name' AND f.realisateur_id = r.id_realisateur");
    $filmsStatement->execute();
    return $filmsStatement->fetchAll();
}

function miseaJourSynopsis($film_id, $title, $synopsis)
{        
    global $db;
    $filmsStatement = $db->prepare("UPDATE films f
                                    SET f.synopsis = '$synopsis', f.titre_film = '$title'
                                    WHERE f.id_film = $film_id;");
    $filmsStatement->execute();
}

function getRealId($real){
    global $db;
    $name = trim($real['nom']);
    $fName = trim($real['prenom']);
    $bDay = trim($real['date']);
    $filmsStatement = $db->prepare("SELECT r.id_realisateur, r.prenom_realisateur, r.nom_realisateur, r.date_realisateur
                                    FROM realisateurs r
                                    WHERE  r.nom_realisateur = '$name' AND r.prenom_realisateur = '$fName' AND r.date_realisateur = '$bDay' ");
    debug::debug($filmsStatement);
    $filmsStatement->execute();
    return $filmsStatement->fetchAll();
}

function addFilm($filmData)
{        
    global $db;
    $title = $filmData['film']['title'];
    $date = $filmData['realisateur']['date'];
    $note = 3;
    $synopsis = $filmData['film']['synopsis'];
    $genre = 1;
    $real = getRealId($filmData['realisateur']);
    debug::debug($filmData);
    if ($real) {
        $id_real = $real[0]['id_realisateur'];
        debug::debug($date);
        file_put_contents('./output2.txt', $date);
        $filmsStatement = $db->prepare("INSERT INTO films (titre_film, note, synopsis, genre_id, realisateur_id)
                                        VALUES ('$title', '$note', '$synopsis', '$genre', '$id_real')");
        return $filmsStatement->execute();
    }
}

?>