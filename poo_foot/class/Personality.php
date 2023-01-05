<?php
    // classe abstraite Personality (ne peut pas être instanciée directement !!!)
    // qui regroupe des propriétés communes 
    // unitlisé dans Club & Player
    abstract class Personality
    {
        private $name;      // nom du Club ou Joueur 
        private $country;   // Nationalité du Joueur ou ville du Club
        private $date;      // Date de création du Club ou Date de naissance du Joueur

        public function __construct($name, $country, $bDay)
        {
            // initialisation des propriétés 
            // avec les valeurs passés en paramètre
            $this->name = $name;
            $this->country = $country;
            $this->date = new DateTime($bDay);
        }

        // renvoi le nom
        public function getName()
        {
            return $this->name;
        }

        // met à jour le nom 
        public function setName($name)
        {
            $this->name = $name;
        }

        // renvoi le nom de la ville du Club 
        // ou le nom de la ville dans laquelle le joueur joue
        public function getCountry()
        {
            return $this->country;
        }

        // met à jour la ville 
        public function setCountry($country)
        {
            $this->country = $country;
        }

        // renvoi la date de naissance
        public function getBirthDate()
        {
            return $this->date;
        }

        // renvoi l'age du joueur ou du Club
        public function getAge()
        {
            return $this->date->diff(new DateTime())->y;
        }

        // fonction dite "magique" 
        // appelée automatiquement lors d'un (echo) sur l'objet 
        // qui hérite de Personality (Club & Player)
        // Ex. "echo $player1"
        public function __toString()
        {
            return "$this->firstName $this->name ". $this->getAge() . " ans";
        }
    }