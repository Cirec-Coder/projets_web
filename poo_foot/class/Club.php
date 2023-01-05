<?php
    final class Club extends Personality
    {
        // propriétés 
        private $city;          // la ville du Club
        private Team $team;     // l'équipe du Club

        public function __construct(Country $country, $name, $city, $date)
        {
           // appel le constructeur parent
           parent::__construct($name, $country->getName(), $date);
           // initialisation des propriétés 
           $this->city = $city;
           // crée un équipe
           $this->team = new Team($this);
           // et on ajoute le Club à l'objet Country (pays)
           $country->addClub($this);
        }

        // ajoute un joueur passé en paramètre au tableau de joueurs
        // situé dans team
        public function addPlayer(Player $player)
        {
            $this->team->addPlayer($player);
        }

        // renvoi la ville du club
        public function getCity()
        {
            return $this->city;
        }

        // renvoi l'objet Team
        public function getTeam()
        {
            return $this->team;
        }

        // renvoi le tableau de joueurs
        public function getPlayers(): array
        {
            return $this->team->getPlayers();
        }
        // renvoi la liste des joueurs de l'équipe
        public function listPlayer()
        {
            return $this->team->listPlayers();
        }

        // pas de fonction __toString ici
        // on hérite de la fonction du parent
    }
