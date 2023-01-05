<?php
    // classe Team (équipe)
    class Team 
    {
        private array $players;  // Tableau d'objet joueur (Player)
        private Club $club;

        public function __construct($club)
        {
            // initialisation des propiétés
            $this->players = [];
            $this->club = $club;
        }

        // ajoute un joueur (passé en paramètre)
        // au tableau de Joueurs
        public function addPlayer(Player $player)
        {
            $this->players[] = $player;
        }

        //renvoi le tableau de joueurs
        public function getPlayers()
        {
            return $this->players;
        }
        // Liste tous les joueurs de l'équipe (Team)
        public function listPlayers()
        {
            echo "<b>Liste des joueurs du :</b> ".$this->club->getName()."<br>";
            foreach ($this->players as $key => $value) {
                echo "&emsp;".$value."<br>";
            }
        }
    }