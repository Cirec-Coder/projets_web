<?php
    // Classe Livre :
    // le Titre 
    // le Nombre de pages
    // la Date de Parution
    // le Prix
    // et son Auteur (classe)
    final class Livre
    {
        private $titre;
        private $nbPages;
        private $dateParution;
        private $prix; 
        private Auteur $auteur;

        public function __construct($auteur, $titre, $nbPages, $dateParution, $prix)
        {
            $this->auteur = $auteur;
            $this->titre = $titre;
            $this->nbPages = $nbPages;
            $this->dateParution = $dateParution;
            $this->prix = $prix;
            // ajout du livre dans la classe Auteur 
            if (!$titre == null and !$prix == 0) {
                $this->auteur->addLivre($this);
            }
            
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


?>