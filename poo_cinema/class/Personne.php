<?php
  require "func/func_DateTime.php";
  // définition d'une classe "de base" qui va servir
  // à créer les classes Acteur & Realisateur par héritage
  // voir Acteur.php & Realisateur.php
    class Personne {
        // déclaration de propriétés 
        private $nom;
        private $prenom;
        private $sex;
        private DateTime $dateNaissance;

        // fonction "magique" appélé automatiquement 
        // quand on instancie un objet personne
        // avec new
        public function __construct($prenom, $nom, $sex, $dateNaissance)
        {
            // initialise l'objet avec les valeurs passé au constructeur
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sex = $sex;
            $this->dateNaissance = new DateTime($dateNaissance);
        }

         // renvoi le Nom 
         public function getNom() {
            return $this->nom;
        }

        // met à jour le nom  avec la valeur passé en paramètre
        public function setNom($name) {
            $this->nom = $name;
        }

        // renvoi le Prénom 
        public function getPrenom() {
            return $this->prenom;
        }

        // met à jour le prénom avec la valeur passé en paramètre  
        public function setPrenom($firstName) {
            $this->prenom = $firstName;
        }

        // renvoi le sex 
        public function getSex() {
            return $this->sex;
        }

        // met à jour le sex avec la valeur passé en paramètre
        public function setSex($sex) {
            $this->sex = $sex;
        }

        // renvoi l'objet DateTime
        public function getDateNaissance(): DateTime {
            return $this->dateNaissance;
        }

        // met à jour la date de naissance avec la valeur ($bDay)
        // passée en paramètre de la fonction
        public function setDateNaissance($bDay) {
            $this->dateNaissance = new DateTime($bDay);
        }

        // renvoi la date de naissance sous 
        // forme de chaine de caractères formatée (string)
        // Ex.: 01 mai 1989
        // nb : fait appel à la fonction (privé) formateDate dans func_DateTime.php
        public function getBirthDay() {
            return formatDate($this->dateNaissance, "d MMMM yyyy");
        }
        
        // renvoi l'age sous forme d'entier : (int)
        public function getAge() {
            return $this->dateNaissance->diff(new DateTime("now"))->y;
        }

        // function "magique" qui est appelé automatiquement 
        // lors d'un (echo) sur l'objet ex.: (echo $personne1)
        public function __toString()
        {
           $return = "";
           $return .= $this->getPrenom() . " " . 
                      $this->getNom() ." ". 
                      $this->getAge(). " ans";
           return $return;
        }
   }
