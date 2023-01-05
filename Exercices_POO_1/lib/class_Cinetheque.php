<?php
    class Cinetheque {
        private array $films;
        private array $realisateurs;
        private array $acteurs;

        public function __construct()
        {
            $this->films = [];
            $this->realisateurs = [];
            $this->acteurs = [];
        }
        public function addFilm(Film $film) {
            $this->films[] = $film;
        }

        public function addRealisateur(Realisateur $realisateur) {
            $this->realisateurs[] = $realisateur;
            //$this->realisateurs = array_unique($this->realisateurs);
            
        }

        public function addActeur(Acteur $acteur) {
            $this->acteurs[] = $acteur;
            $this->acteurs = array_unique($this->acteurs);
        }

        public function listerRealisateurs() {
            foreach ($this->realisateurs as $realisateur) {
                echo $realisateur->getNom()." ".$realisateur->getPrenom()."<br>";
            }
        }
        public function listerActeurs() {
            foreach ($this->acteurs as $acteur) {
                echo $acteur->getPrenom() . " " . $acteur->getNom(). " <b>né le : </b>" . $acteur->getBirthDay() . "<br>" ;
            }
        }

        public function listerFilms() {
            foreach ($this->films as $film) {
                echo $film->getTitle() . " " . $film->getAnneeDeSortie() . " " . 
                    $film->getRealisateur()->getPrenom() . " " . 
                    $film->getRealisateur()->getNom() . " Durée " . 
                    $film->getDuree() . "mn (" . 
                    $film->getDureeHrsMn() . ")<br>";   
            }
        }
    }
?>