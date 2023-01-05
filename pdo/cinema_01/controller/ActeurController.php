<?php

// namespace est un moyen de séparer des éléments au sein du code dans le but 
// d'éviter les collisions dues à des duplication de noms
namespace Controller;

use model\Connect;

class ActeurController
{
    // retourne la liste des Acteurs
    public function listActeurs()
    {
        $pdo = Connect::seConnecter();
        $listActeurs = $pdo->query("SELECT *, CONCAT(prenom_acteur, ' ', nom_acteur) AS full_name  
                                    FROM acteurs ORDER BY full_name asc");

        require "view/list/acteurCards.php";
    }

    public function deleteActeur($id)
    {
        $pdo = Connect::seConnecter();

        $request = $pdo->prepare("DELETE FROM castings
        WHERE acteur_id = :id; 
        
        DELETE FROM acteurs
        WHERE id_acteur = :id;");

        $request->bindParam(':id', $id);

        $request->execute();

        $this->listActeurs();
    }

    // Ajoute un acteur à la table Acteurs
    public function addActeur()
    {
        if (!empty($_POST['action'])) {

            // uplod de la photo du réalisateur
            if (isset($_FILES["photo"])) {
                $tmpName = $_FILES["photo"]["tmp_name"];
                $name = $_FILES["photo"]["name"];
                $size = $_FILES["photo"]["size"];
                $error = $_FILES["photo"]["error"];

                // explode permets de découper une chaîne de caractère en plusieurs morceaux à partir d’un délimiteur ! exemple: explode(".", "image.jpg")  Ce qui nous donne un tableau avec 2 éléments, comme ceci [« image », « jpg »].
                $tabExtension = explode('.', $name);

                // strtolower => met en minuscule tout une chaine de caractère // end() => Recupere le dernier élément du tableau
                $extension = strtolower(end($tabExtension));

                //Tableau des extensions que l'on accepte !
                $extensions = ["jpg", "png", "jpeg", "gif", "webp", "avif"];

                // Taille max que l'on accepte !
                $maxSize = 400000;

                if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                    // uniqid génère un id unique dans la base de donnée concernant la photo, le rendu donne un truc dans le genre: 62a88fdbe59848.25382994.jpg
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;
                    move_uploaded_file($tmpName, './public/img/' . $file);
                } else {
                    echo "erreur: Mauvaise extensions ou taille de l'image trop volumineux ou autre erreur ";
                }
            }
            // récupération des données saisie que l'on filtre directement
            // Empêcher une faille XSS avec validation de l'entrée et un encodage de l'entrée.
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sex = filter_input(INPUT_POST, 'sex', FILTER_VALIDATE_INT);

            // connection à la base
            $pdo = Connect::seConnecter();
            // préparation de la requête d'insertion
            $request = $pdo->prepare("INSERT INTO acteurs (nom_acteur, prenom_acteur, sex, photo, date_acteur) 
                                      VALUES (:nom_acteur, :prenom_acteur, :sex, :photo, :date_acteur)
                                      ");
            // lie les colonnes de la table aux valeurs retournées par le formulaire
            $request->bindParam(":nom_acteur", $name);
            $request->bindParam(":prenom_acteur", $fname);
            $request->bindParam(":sex", $sex);
            $request->bindParam(":photo", $file);
            $request->bindParam(":date_acteur", $date);
            // et on exécute la requête 
            // qui va ajouter les donnée à la table acteurs
            $request->execute();
        }
        require "view/list/addActeur.php";
    }

    public function showActeurFilmo($id)
    {
        $pdo = Connect::seConnecter();

        $filmoActeur = $pdo->prepare("SELECT * 
                                      FROM films, acteurs, castings
                                      WHERE :id = id_acteur AND id_acteur = acteur_id AND film_id = id_film");
        $filmoActeur->bindParam(':id', $id);
        $filmoActeur->execute();

        require "view/list/acteurFilmoCard.php";
    }
}
