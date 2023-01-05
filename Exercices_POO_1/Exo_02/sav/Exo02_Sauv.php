<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices POO MMU V1.0</title>
</head>

<body>
    <h1>Exercice N° 2</h1>
    <p><strong><u>Vous êtes chargé(e) de créer un projet orienté objet permettant de gérer des livres et<br>
                leurs auteurs respectifs.<br></u></strong>
        Les livres sont caractérisés par un titre, un nombre de pages, une année de parution, un prix et un<br>
        auteur. Un auteur comporte un nom et un prénom.<br>
        Une méthode toString() sera appréciée dans chacune de vos classes.<br>
        Vous implémenterez une méthode <em>afficherBibliographie()</em> qui permettra d’afficher la bibliographie<br>
        complète d’un auteur :
    </p>
    <img src="./Img_Exo2.jpg" alt="Img_Exo2"><br>
    <?php

    // use Livre as GlobalLivre;

    // use function PHPSTORM_META\type;

    final class Livre
    {
        private $titre;
        private $nbPages;
        private $dateParution;
        private $prix;

        public function __construct($titre, $nbPages, $dateParution, $prix)
        {
            $this->titre = $titre;
            $this->nbPages = $nbPages;
            $this->dateParution = $dateParution;
            $this->prix = $prix;
        }

        public function getTitre()
        {
            return $this->titre;
        }

        public function getNbPage()
        {
            return $this->nbPages;
        }

        public function getDateParution()
        {
            return $this->dateParution;
        }

        public function getPrix()
        {
            return $this->prix;
        }

        public function setTitre($valeur)
        {
            $this->titre = $valeur;
        }

        public function setNbPage($valeur)
        {
            $this->nbPages = $valeur;
        }

        public function setDateParution($valeur)
        {
            $this->dateParution = $valeur;
        }

        public function setPrix($valeur)
        {
            $this->prix = $valeur;
        }

        public function __toString()
        {
            return $this->getTitre() . " (" . $this->getDateParution() . ") : " . $this->getNbPage() . " pages / " . $this->getPrix() . " €<br>";
        }
    }
    final class Auteur
    {
        private string $nom;
        private string $prenom;
        private $biblio;

        //private livre $livre;
        public function __construct($nom, $prenom)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->biblio = array();
        }

        public function getLivreData(Livre $livre)
        {
            return $livre;
        }

        public function getLivre($titre): Livre
        {
            foreach ($this->biblio as $livre) {
                if (($livre)->getTitre() == $titre) {
                    return $livre;
                }
            }
        }

        public function ajoutLivre($titre, $nbPages, $dateParution, $prix)
        {
            $this->biblio[] = new Livre($titre, $nbPages, $dateParution, $prix);
        }

        public function __toString()
        {
            $ret = "<h2>Livres de " . $this->prenom . " " . $this->nom . "</h2>";
            foreach ($this->biblio as $livre) {
                $ret = $ret . $this->getLivreData($livre);
            }


            // public function getLivre($titre): Livre {

            // }
            return $ret;
        }
    }


    $aut1 = new Auteur("King", "Stephen");
    $aut1->ajoutLivre("Ca", 1138, 1986, 20);
    $aut1->ajoutLivre("Simetierre", 374, 1983, 15);
    $aut1->ajoutLivre("Le Fléau", 823, 1978, 14);
    $aut1->ajoutLivre("Shining", 447, 1977, 16);

    echo $aut1;

    $aut1->getLivre("Ca")->setPrix(40);

    echo $aut1;
    ?>
</body>

</html>