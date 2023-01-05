<?php
  include("func_DateTime.php");
    class Personne {
        private $nom;
        private $prenom;
        private $sex;
        private DateTime $dateNaissance;

        public function __construct($nom, $prenom, $sex, $dateNaissance)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sex = $sex;
            $this->dateNaissance = new DateTime($dateNaissance);
        }

        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        
        public function getSex() {
            return $this->sex;
        }

        public function getDateNaissance() {
            return $this->dateNaissance;
        }

        public function getBirthDay() {
            return formatDate($this->dateNaissance, "d MMMM yyyy");
        }
        
        public function getAge() {
            return $this->dateNaissance->diff(new DateTime("now"))->y;
        }
    }
?>