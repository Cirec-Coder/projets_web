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
            if ($this->titre <> "") {
                echo "<br>Le prix du livre \"$this->titre\" passe à $valeur €<br>";
                $this->prix = $valeur;
            }
        }

        public function __toString()
        {
            return $this->getTitre() . " (" . $this->getDateParution() . ") : " . $this->getNbPage() . " pages / " . $this->getPrix() . " €<br>";
        }
    }

    abstract class Auteurs
    {
        private string $nom;
        private string $prenom;

        public function __construct($prenom, $nom)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getPrenom()
        {
            return $this->prenom;
        }
    }

    final class Auteur extends Auteurs
    {
        private $biblio;

        public function __construct($prenom, $nom, $livres = array(), $sorted = false)
        {
            parent::__construct($prenom, $nom);
            $this->biblio = array();
            if (count($livres) > 0 ) { 
                if ($sorted) {
                    asort($livres);
                } 
                foreach ($livres as $livre) {
                    $this->setLivre($livre[0], $livre[1], $livre[2], $livre[3]);
                    
                }
            }
        }

        public function getLivre($titre)
        {
            foreach ($this->biblio as $livre) {
                if (mb_strtoupper($livre->getTitre()) == mb_strtoupper($titre)) {
                    return $livre;
                }
            }
            echo "<br>Le livre " . $titre . " de $this ne figure pas dans la liste !";
            // permet d'éviter une erreur d'accès 
            // si le livre $titre n'existe pas
            return $livre = new Livre("", 0, 0, 0);
        }

        public function setLivre($titre, $nbPages, $dateParution, $prix)
        {
            $this->biblio[] = new Livre($titre, $nbPages, $dateParution, $prix);
        }

        public function __toString()
        {
            return $this->getPrenom() . " " . $this->getNom();
        }

        public function afficherBibliographie()
        {
            $ret = "<h2>Livres de " . $this . "</h2>";
            foreach ($this->biblio as $livre) {
                $ret = $ret . $livre;
            }
            return $ret;
        }
    }


    $aut1 = new Auteur("Stephen", "King");
    $aut1->setLivre("Ca", 1138, 1986, 20);
    $aut1->setLivre("Simetierre", 374, 1983, 15);
    $aut1->setLivre("Le Fléau", 823, 1978, 14);
    $aut1->setLivre("Shining", 447, 1977, 16);

    echo $aut1->afficherBibliographie();
    // teste de modification d'un prix
    $aut1->getLivre("Ca")->setPrix(40);
    // affichage du prix modifié
    echo $aut1->getLivre("Ca");

    // teste de modification d'un prix sur un livre inexistant
    $aut1->getLivre("Californie")->setPrix(40);
    // echo $aut1->afficherBibliographie();

    $aut2 = new Auteur("Jules", "Vernes", [
                ["Voyage au centre de la Terre", 389, 1864, 6.95], 
                ["De la Terre à la Lune", 475, 1865, 7.95], 
                ["L'Île mystérieuse", 826, 1875, 8.95], 
                ["20 Mille lieues sous les mers", 687, 1869, 12]
            ], true);
    echo $aut2->afficherBibliographie();

    ?>
</body>

</html>