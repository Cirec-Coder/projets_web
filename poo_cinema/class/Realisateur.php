<?php
    // classe Realisateur hérite de Personne
    class Realisateur extends Personne {
        /*
            $prenom,  
            $nom, 
            $sex, 
            $dateNaissance 
            sont héritées de la classe Personne et sont accessibles 
            dans la classe Realisateur et dans l'objet instancié
        */

        // ajout de propriétés (variables) propre à la classe
        private $films = [];  // Def. un tableau de films

         /*
            permet d'initialiser l'objet que l'on vient d'instancier
            la fonction __construct est appellé automatiquement par "new"
            ce qui la place dans les fonctions dites "magique"
        */
        public function __construct($prenom, $nom, $sex, $dateNaissance)
        {
            // appel le constructeur parent
            parent::__construct($prenom, $nom, $sex, $dateNaissance);
            // initialise le tableau 
            $this->films = [];
        }

        // ajoute le film passé en paramètre 
        // au tableau films[]
        public function addFilm(Film $film) {
            $this->films[] = $film;
        }

        // renvoie le tableau de films
        public function getFilms(): array
        {
            return $this->films;
        }

        // Affiche "echo" la filmographie du réalisateur
        public function getFilmo(){
           echo "<br><b>Films de : </b><i>" . $this->getPrenom() . " " . $this->getNom(). "</i><br>";
           foreach ($this->films as $film) {
                echo "&emsp; - ".$film->getShortInfo()."<br>";
           }
        }
        // pas de fonction __toString() déclarée ici
        // on hérite de celle du parent (class Personne)
        // c'est donc cette dernière qui sera affiché à la demande

    }
