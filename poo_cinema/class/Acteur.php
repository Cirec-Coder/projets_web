<?php
    // classe Acteur hérite de Personne
    class Acteur extends Personne {
        /*
            $prenom,  
            $nom, 
            $sex, 
            $dateNaissance 
            sont héritées de la classe Personne et sont accessible 
            dans la classe Acteur et dans l'objet instancié
        */

        // ajout de propriétés (variables) propre à la classe
        private $roles;
        private $films;
        private array $castings;

        /*
            permet d'initialiser l'objet que l'on vient d'instancier
            la fonction __construct est appellé automatiquement par "new"
            ce qui la place dans les fonctions dites "magique"
        */
        public function __construct($prenom, $nom, $sex, $dateNaissance)
        {
            // appel le constructeur parent
            parent::__construct($prenom, $nom, $sex, $dateNaissance);
            $this->roles = [];
            $this->films = [];
            $this->castings = [];
        }

        // ajoute le casting passé en paramètre de la fonction 
        // au tableau castings[]
        public function addCasting(Casting $casting)
        {
            $this->castings[] = $casting;
            
        }

        // ajoute le role & le film passés en paramètres de la fonction 
        // dans leurs tableau respectif
        public function addRole(Role $role, Film $film) {
            $this->roles[] = $role;
            $this->films[] = $film;
        }

        // renvoie le tableau de films
        public function getFilms(): array
        {
            return $this->films;
        }

        // Affiche "echo" la filmographie de l'acteur
        public function getFilmo(){
            echo "<br><b>Films avec : </b><i>".$this."</i><br>";
            $i = 0;
            foreach ($this->films as $film) {
                    echo "&emsp; - ".$film."<br>"." &emsp;&emsp;&emsp;<b>dans le role de : </b><i>". $this->roles[$i]->getRoleName()."</i><br>";
                    $i++;
            }
        }

        // pas de fonction __toString() déclarée ici
        // on hérite de celle du parent (class Personne)
        // c'est donc cette dernière qui sera affiché à la demande

     }
?>