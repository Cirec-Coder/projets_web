<?php
    // Classe Role 
    // possède un Nom de role
    // et un casting associé (quels acteurs on joué ce role dans quel film ?)
    class Role 
    {

        private $nomRole;
        private array $castings;

        public function __construct($nomRole)
        {
            // initialisation des propriétés
            $this->nomRole = $nomRole;
            $this->castings = [];
        }
        // renvoi le Nom du role
        public function getRoleName() {
            return $this->nomRole;
        }

        // met à jour le nomRole avec la valeur passé en paramètre de la fonction
        public function setRoleName($roleName) {
            $this->nomRole = $roleName;
        }

        // ajoute le casting passé en paramètre au tableau de casting : "castings[]"
        public function addCasting(Casting $casting)
        {
            $this->castings[] = $casting;
        }

        // renvoi le tableau de casting
        public function getCasting()
        {
            return $this->castings;
        }

        // affiche (echo) la liste des acteurs ayant interpreté le rol "nomRole"
        public function showCasting()
        {
             echo "<br><b>Acteur(s) ayant joué le role de : </b><em>".$this."</em><br>";
            foreach ($this->castings as $casting) {
                echo "&emsp;<i>".$casting->getActeur()." </i><b>dans :</b><br>";
                echo "&emsp;&emsp;".$casting->getFilm()."<br>";
            }
        }

        // function "magique" qui est appelé automatiquement 
        // lors d'un (echo) sur l'objet ex: (echo $role1)
        public function __toString()
        {
            return $this->nomRole;
        }
    }
