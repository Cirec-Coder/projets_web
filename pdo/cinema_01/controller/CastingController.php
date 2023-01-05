<?php

// namespace est un moyen de séparer des éléments au sein du code dans le but 
// d'éviter les collisions dues à des duplication de noms
namespace Controller;

use model\Connect;

class CastingController
{
    public function showCasting()
    {
        $pdo = Connect::seConnecter();
        $showCasting = $pdo->query("SELECT titre_film, CONCAT(prenom_acteur, ' ', nom_acteur) AS Nom_act 
                                  FROM castings, films, acteurs
                                  WHERE id_film = film_id AND acteur_id = id_acteur");


        require "view/list/casting.php";
    }


    public function addCasting($id)
    {
        $pdo = Connect::seConnecter();
        $listActeurs = $pdo->query("SELECT * FROM acteurs");

        if (!empty($_POST['action'])) {
            // $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idActeur = filter_input(INPUT_POST, 'selectActeur', FILTER_VALIDATE_INT);
            // connection à la base
            $pdo = Connect::seConnecter();
            // préparation de la requête d'insertion
            $request = $pdo->prepare("INSERT INTO castings (film_id, acteur_id) VALUES (:idFilm, :idActeur)");
            // lie les colonnes de la table aux valeurs retournées par le formulaire
            $request->bindParam(":idFilm", $id);
            $request->bindParam(":idActeur", $idActeur);
            // et on exécute la requête 
            // qui va ajouter les donnée à la table castings
            $request->execute();
        }
         require "view/list/addCasting.php";
    }
}
