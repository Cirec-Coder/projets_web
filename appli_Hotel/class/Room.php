<?php
    class Room {
        private int $roomNumber;
        private int $nbPlace;
        private int $nbBed;
        private int $price;
        private bool $wifi;
        private bool $reserved;

        public function __construct($roomNumber, $nbPlace, $nbBed, $price, bool $wifi, bool $reserved)
        {
            $this->roomNumber = $roomNumber;
            $this->nbPlace = $nbPlace;
            $this->nbBed = $nbBed;
            $this->price = $price;
            $this->wifi = $wifi;
            $this->reserved = $reserved;
        }

        // renvoi le numéro de la chambre
        public function getRoomNumber()
        {
            return $this->roomNumber;
        }

        // renvoi le nombre de places
        public function getNbPlace()
        {
            return $this->nbPlace;
        }
        
        // renvoi le nombre de lits
        public function getNbBed()
        {
            return $this->nbBed;
        }

        // renvoi le prix de la chambre
        public function getPrice()
        {
            return $this->price;
        }
        
        // renvoi true si la chambre est équipée wifi
        public function getWifi(): bool
        {
            return $this->wifi;
        }
        
        // renvoi true si la chambre est reservée
        public function getReserved(): bool
        {
            return $this->reserved;
        }
        
        // met à jour la reservation avec la valeur passée en paramètre
        public function setReserved($reserved)
        {
            $this->reserved = $reserved;
        }
        
        // fonction "magique" apppelée 
        // automatiquement lors d'un (echo) sur un objet Room
        public function __toString()
        {
            return $this->roomNumber." ".$this->price;
        }
    }
?>