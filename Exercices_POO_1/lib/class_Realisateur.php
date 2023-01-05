<?php
    class Realisateur extends Personne {  
        private $films = [];
        private Cinetheque $cinetheque;

        public function __construct(Cinetheque $cinetheque, $nom, $prenom, $sex, $dateNaissance)
        {
            parent::__construct($nom, $prenom, $sex, $dateNaissance);
            $this->cinetheque = $cinetheque;
            $this->cinetheque->addRealisateur($this);
        }

        // public function getId() {
        //     return $this->getPrenom().$this->getNom();
        // }

        // public function getLastFilm(): Film {
        //     return $this->films[count($this->films)-1];
        // }

        public function addActeur(Acteur $acteur) {
            $this->cinetheque->addActeur($acteur);
        }

        public function addFilm(Film $film) {
            $this->films[] = $film;
            $this->cinetheque->addFilm($film);
        }
    }
?>
