<?php

// namespace est un moyen de séparer des éléments au sein du code dans le but 
// d'éviter les collisions dues à des duplication de noms
namespace Controller;

use DateTime;
use model\Connect;

class FilmController
{
    public function listFilms()
    {
        $pdo = Connect::seConnecter();
        $listFilms = $pdo->query("SELECT * FROM films, realisateurs, genres
                                      where realisateur_id = id_realisateur AND genre_id = id_genre
                                      ORDER BY titre_film asc");

        require "view/list/filmCards.php";
    }

    public function showFilm($id)
    {
        // connexion à la base de données
        $pdo = Connect::seConnecter();

        // préparation de la requête avec des marqueurs 
        //à la place des variables passées en paramètre
        $listFilms = $pdo->prepare("SELECT * 
            FROM films, realisateurs, genres
            WHERE :id = id_film 
            AND realisateur_id = id_realisateur 
            AND genre_id = id_genre");
        // on lie les paramètres aux marqueurs
        $listFilms->bindParam(':id', $id);
        // et on exécute la requête
        $listFilms->execute();

        require "view/list/filmCards.php";
    }

    public function addFilm()
    {
        $pdo = Connect::seConnecter();
        $listRealisateurs = $pdo->query("SELECT * FROM realisateurs");

        $pdo = Connect::seConnecter();
        $listGenre = $pdo->query("SELECT * FROM genres");


        if (!empty($_POST['action'])) {
            // uplod de l'affiche du Film
            if (isset($_FILES["affiche"])) {
                $tmpName = $_FILES["affiche"]["tmp_name"];
                $name = $_FILES["affiche"]["name"];
                $size = $_FILES["affiche"]["size"];
                $error = $_FILES["affiche"]["error"];

                // explode permets de découper une chaîne de caractère en plusieurs morceaux à partir d’un délimiteur ! exemple: explode(".", "image.jpg")  Ce qui nous donne un tableau avec 2 éléments, comme ceci [« image », « jpg »].
                $tabExtension = explode('.', $name);

                // strtolower => met en minuscule tout une chaine de caractère // end() => Recupere le dernier élément du tableau
                $extension = strtolower(end($tabExtension));

                //Tableau des extensions que l'on accepte !
                $extensions = ["jpg", "png", "jpeg", "gif", "webp", "avif"];

                // Taille max que l'on accepte !
                $maxSize = 400000;

                if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                    // uniqid génère un id unique dans la base de donnée concernant l'affiche, le rendu donne un truc dans le genre: 62a88fdbe59848.25382994.jpg
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;
                    move_uploaded_file($tmpName, './public/img/' . $file);
                } else {
                    echo "erreur: Mauvaise extensions ou taille de l'image trop volumineux ou autre erreur ";
                }
            }



            // ***************************************************************************
            # comment se prémunir de la faille XSS (Cross Side Scripting)
            // est une faille de sécurité qui permet à un attaquant d'injecter 
            // dans un site web un code client malveillant.
            // Une faille cross-site scripting ou XSS est un script qui peut être exécuté dans votre site web.

            // Empêcher une faille XSS avec validation de l'entrée et un encodage de l'entrée.
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
            $genre = filter_input(INPUT_POST, 'selectGenre', FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_INT);
            $idreal = filter_input(INPUT_POST, 'selectRealisateur', FILTER_VALIDATE_INT);
            $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $d = new DateTime($date);
            $date = $d->format('Y');

            $pdo = Connect::seConnecter();
            $request = $pdo->prepare("INSERT INTO films (titre_film, date_sortie, duree, note, synopsis, affiche, genre_id, realisateur_id) 
                                      VALUES (:titre_film, :date_sortie, :duree, :note, :synopsis, :affiche, :genre_id, :realisateur_id)
                                      ");
            $request->bindParam(":titre_film", $title);
            $request->bindParam(":date_sortie", $date);
            $request->bindParam(":duree", $duree);
            $request->bindParam(":note", $note);
            $request->bindParam(":synopsis", $synopsis);
            $request->bindParam(":affiche", $file);
            $request->bindParam(":genre_id", $genre);
            $request->bindParam(":realisateur_id", $idreal);

            $request->execute();
        }
        require "view/list/addFilm.php";
    }

    public function showFilmCasting(int $id)
    {
        $pdo = Connect::seConnecter();
        $castings = $pdo->query("SELECT *, CONCAT(prenom_acteur, ' ', nom_acteur) AS full_name 
                                  FROM castings, films, acteurs
                                  WHERE id_film = $id  AND id_film= film_id AND acteur_id = id_acteur");

        $idFilm = $id;

        require "view/list/showFilmCasting.php";
    }

    public function deleteCastingActeur($idActeur, $idFilm)
    {
        $pdo = Connect::seConnecter();

        $request = $pdo->prepare("DELETE FROM castings
                                  WHERE film_id = :idFilm AND acteur_id = :idActeur;");

        $request->bindParam(':idFilm', $idFilm);
        $request->bindParam(':idActeur', $idActeur);

        $request->execute();

        $this->showFilmCasting($idFilm);
    }

    public function deleteFilm(int $id)
    {
        $pdo = Connect::seConnecter();

        $request = $pdo->prepare("DELETE FROM castings
                                  WHERE film_id = :id; 
                                  
                                  DELETE FROM films
                                  WHERE id_film = :id;");

        $request->bindParam(':id', $id);

        $request->execute();

        $this->listFilms();
    }

}
