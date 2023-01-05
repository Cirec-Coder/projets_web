<?php

// namespace est un moyen de séparer des éléments au sein du code dans le but 
// d'éviter les collisions dues à des duplication de noms
namespace Controller;

use model\Connect;

class GenreController
{
    public function listGenres()
    {
        $pdo = Connect::seConnecter();
        // modifier en 
        // -- retourne le nombre de films par genre même si zéro film dans le genre
        // -- grâce au LEFT JOIN                                  
        // ("SELECT nom_genre, COUNT(genre_id) AS "number_of_genre"
        // FROM genres 
        //   LEFT JOIN films ON id_genre = genre_id
        // GROUP BY nom_genre
        // ORDER BY nom_genre;") 
        //                                   

        $listGenres = $pdo->query("SELECT * FROM genres ORDER BY nom_genre asc");

        require "view/list/genre.php";
    }

    public function addGenre()
    {
        if (!empty($_POST['action'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // connection à la base
            $pdo = Connect::seConnecter();
            // préparation de la requête d'insertion
            $request = $pdo->prepare("INSERT INTO genres (nom_genre) VALUES (:nom_genre)");
            // lie les colonnes de la table aux valeurs retournées par le formulaire
            $request->bindParam(":nom_genre", $name);
            // et on exécute la requête 
            // qui va ajouter les donnée à la table genres
            $request->execute();
        }
        require "view/list/addGenre.php";
    }

    public function filmsByGenre(int $id)
    {
        $pdo = Connect::seConnecter();
        $listFilms = $pdo->query("SELECT * 
                                  FROM films, genres, realisateurs
                                  WHERE id_genre = $id  AND id_genre = genre_id AND realisateur_id = id_realisateur ORDER BY titre_film");

        $actionName = 'par Genre';



        require "view/list/filmCards.php";
    }

}
