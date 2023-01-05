<?php
    // classe Player (Joueur)
    final class Player extends Personality
    {
        private $firstName;             // prénom du joueur
        private $nationality;           // sa nationalité
        private $currentClub;           // son Club actuel
        private array $previusClubs;    // la liste de ses anciens Clubs

        public function __construct(Club $club, $firstName, $name, $bDay, $nationality)
        {
           // appel le constructeur parent
           parent::__construct($name, $club->getCity(), $bDay);
           // inialisation des propriétés avec les valeurs passées en paramètre
           $this->firstName = $firstName;
           $this->nationality =  $nationality;
           $this->clubs = [];
           $this->currentClub = $club;
           // ajout du joueur dans l'équipe (le tableau de joueurs dans Club)
           $club->addPlayer($this);
           $this->previusClubs = [];        
        }

        // renvoi le prénom du joueur
        public function getFirstName()
        {
            return $this->firstName;
        }

        // met à jour son prénom  avec la veleur passée en paramètre
        // (si il devait en changer ^^)
        public function setFirstName($firtsName)
        {
            $this->firstName = $firtsName;
        }

        // renvoi la nationalité du joueur
        public function getNationality()
        {
            return $this->nationality;
        }

        // met à jour sa nationalité avec la veleur passée en paramètre
        public function setNationality($nationality)
        {
            $this->nationality = $nationality;
        }

        // ajoute au tableau associatif (previusClub)
        // les données passées en paramètre
        // Ex. ($player1->addClub(("PSG", "2017")))
        public function addClub($name, $year)
        {
            $this->previusClubs[$name] = $year;
        }

        // renvoi la liste (carrière) du Joueur
        // en commençant par le club actuel puis les autres
        public function listAllClubs()
        {
            echo "<b>Liste des Clubs fréquenté par :</b> $this<br>
            &emsp;Club actuel : ".$this->currentClub->getName()."<br>";

            foreach ($this->previusClubs as $key => $value) {
                echo "&emsp;&emsp; $key $value <br>";
            }
        }

        // fonction "magique" __toString est appelée automatiquement
        // lors d'un (echo)
        public function __toString()
        {
            return $this->getFirstName()." ".$this->getName()." (<b>Age :</b> ".$this->getAge()." <b>ans de Nationalité :</b> ".$this->getNationality().")";
        }

    }