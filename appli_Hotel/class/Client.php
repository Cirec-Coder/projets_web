<?php
    class Client {
        // définitions de propriétés
        private $firstName;                 // Prénom du Client
        private $name;                      // Nom  
        private array $reservations;        // tableau de reservations du Client

        // fonction "magique" appélé automatiquement 
        // quand on instancie un objet personne
        // avec new
        public function __construct($firstName, $name)
        {
            // initialise l'objet avec les valeurs passé au constructeur
            $this->firstName = $firstName;
            $this->name = $name;
            $this->reservations = [];
        }

        // renvoi le Prénom 
        public function getFirstName()
        {
            return $this->firstName;
        }

         // met à jour le prénom avec la valeur passé en paramètre  
         public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

         // renvoi le Nom 
         public function getName()
        {
            return $this->name;
        }

        // met à jour le nom  avec la valeur passé en paramètre
        public function setName($name)
        {
            $this->name = $name;
        }

        // ajoute une réservation (passée en paramètre) au tableau de réservations
        public function addReservation(Reservation $reservation)
        {
            $this->reservations[] = $reservation;
            // $this->reservations = array_unique($this->reservations);
        }

        // renvoi le tableau de resrvations
        public function getReservations()
        {
            return $this->reservations;
        }

        // renvoi le prénom et le nom sans espace
        // utile en interne pour récupérer les sélections depuis "le tableau de bord"
        public function getCondensedName(): string
        {
            return $this->firstName . $this->name;
        }


        // function "magique" qui est appelé automatiquement 
        // lors d'un (echo) sur l'objet e: (echo $client)
        public function __toString()
        {
            return $this->firstName . " " . $this->name;
        }
    }
?>