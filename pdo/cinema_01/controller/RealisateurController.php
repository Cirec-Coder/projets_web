<?php

// namespace est un moyen de séparer des éléments au sein du code dans le but 
// d'éviter les collisions dues à des duplication de noms
namespace Controller;

use model\Connect;

class RealisateurController
{
    public function listRealisateurs()
    {
        $pdo = Connect::seConnecter();
        $listRealisateurs = $pdo->query("SELECT *, CONCAT(prenom_realisateur, ' ', nom_realisateur) AS full_name FROM realisateurs ORDER BY nom_realisateur asc");

        require "view/list/realisateurCards.php";
    }

    public function addRealisateur()
    {
        if (!empty($_POST['action'])) {

            // uplod de la photo du réalisateur
            if (isset($_FILES["photo"])) {
                // var_dump($_FILES["photo"]);
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



            // Empêcher une faille XSS avec validation de l'entrée et un encodage de l'entrée.
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sex = filter_input(INPUT_POST, 'sex', FILTER_VALIDATE_INT);

            // connection à la base
            $pdo = Connect::seConnecter();
            // préparation de la requête d'insertion
            $request = $pdo->prepare("INSERT INTO realisateurs (nom_realisateur, prenom_realisateur, sex, date_realisateur, photo ) VALUES (:nom_realisateur, :prenom_realisateur, :sex, :date_realisateur, :photo)");
            // lie les colonnes de la table aux valeurs retournées par le formulaire
            $request->bindParam(":nom_realisateur", $name);
            $request->bindParam(":prenom_realisateur", $fname);
            $request->bindParam(":sex", $sex);
            $request->bindParam(":date_realisateur", $date);
            $request->bindParam(":photo", $file);
            // et on exécute la requête 
            // qui va ajouter les donnée à la table realisateurs
            $request->execute();
        }
        require "view/list/addRealisateur.php";
    }

    public function showFilmo(int $id)
    {
        $pdo = Connect::seConnecter();

        $filmoReal = $pdo->prepare("SELECT * 
                                        FROM films, realisateurs
                                        WHERE id_realisateur = :id  AND id_realisateur = realisateur_id");
        $filmoReal->bindParam(':id', $id);
        $filmoReal->execute();



        require "view/list/filmoCard.php";
    }


    public function deleteReal(int $id)
    {
        $pdo = Connect::seConnecter();

        // prépare la liste des films du réalisateur
        $request = $pdo->prepare("SELECT * FROM films WHERE :id = realisateur_id");
        $request->bindParam(":id", $id);
        $request->execute();

        $films = $request->fetchAll();
        // pour chaque film
        foreach ($films as $film) {
            $idfilm = $film['id_film'];

            // on supprime le casting puis le film
            $request = $pdo->prepare("DELETE FROM castings
                                  WHERE film_id = :idfilm; 
                                  
                                  DELETE FROM films
                                  WHERE id_film = :idfilm;");

            $request->bindParam(':idfilm', $idfilm);

            $request->execute();
        }

        // pour finir on efface le réalisateur
        $request = $pdo->prepare("DELETE FROM realisateurs
                                WHERE id_realisateur = :id;");

        $request->bindParam(':id', $id);

        $request->execute();
        // et on affiche la liste des films
        $this->listRealisateurs();
    }
}
