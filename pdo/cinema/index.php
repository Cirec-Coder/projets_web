<?php
// require_once("lib/dbconnect.php"); //le fichier de connexion à la BDD
require_once('dbFunctions.php');
require_once("Debug.php"); //pour afficher les données 


// $filmsStatement = $db->prepare('SELECT * FROM films');
// $filmsStatement = $db->prepare('SELECT f.titre_film, f.date_sortie, SEC_TO_TIME(`duree`*60) AS duree,
//                                 CONCAT(r.prenom_realisateur, " ", r.nom_realisateur) AS Nom
//                                 FROM films f, realisateurs r
//                                 WHERE f.realisateur_id = r.id_realisateur');
// $filmsStatement->execute();
// $films = $filmsStatement->fetchAll();

$films = getDbFilms();
// Debug::debug($films);

// $content = file_get_contents('https://www.allocine.fr/film/fichefilm_gen_cfilm=211012.html');

// <a class="xXx thumbnail-container thumbnail-link" title="The Batman" href="/film/fichefilm_gen_cfilm=211012.html">
// <img class="thumbnail-img b-loaded" src="https://fr.web.img3.acsta.net/c_310_420/pictures/22/02/16/17/42/3125788.jpg" alt="The Batman" width="310" height="420">
// </a>

// preg_match('#<div class="titlebar-title titlebar-title-lg">(.*)</div>#', $content, $match);
// $title = $match[0];
// Debug::debug($match);

// preg_match('#<span class="(.*)blue-link">(.*)</span>#', $content, $match);
// $real = $match[2];
// Debug::debug($match);

// echo "title: $title - from: $real\n";

// <a class="xXx meta-title-link" href="/film/fichefilm_gen_cfilm=211012.html">The Batman</a>/
// $content = file_get_contents('https://www.allocine.fr/film/fichefilm_gen_cfilm=211012.html');
// $content = file_get_contents('https://www.allocine.fr/rechercher/?q=le fugitif');
// preg_match('#<div class="synopsis">(.*)</div>#', $content, $match3, PREG_OFFSET_CAPTURE, $p);
//$synopsis = $match3[0];
// Debug::debug($match);
// Debug::debug($match1);
// Debug::debug($match2);
// Debug::debug($match3);
// Debug::debug($synopsis);
// echo $synopsis;
//Debug::debug($content, 'var_dump');

// echo "<div>title: $title from: $real date: $date Synopsy: $synopsis</div>";
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>SQL Cinéthèque</title>
</head>

<body>
    <?php include_once "./view/header.php" ?>
    <main>
        <div class="title-container">
            <div class="tableDiv">
                <!-- <?php include_once "search.php" ?> -->
                <table>
                    <caption>Liste des Films</caption>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date de Sortie</th>
                            <th>Durée</th>
                            <th>Realisateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = '';
                        foreach ($films as $film) {
                            $res .= '<tr>';
                            // echo $adr->getNom();
                            $res .= "<td>" . $film['titre_film'] . "</td>";
                            $res .= "<td>" . $film['date_sortie'] . "</td>";
                            $res .= "<td>" . $film['duree'] . "</td>";
                            $res .= "<td>" . $film['Nom'] . "</td>";
                            $res .= '</tr>';
                        }
                        echo $res;
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include_once "./view/footer.php" ?>
</body>

</html>