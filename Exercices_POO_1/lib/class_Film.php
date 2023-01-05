<?php
    class Film {
        private $titre;
        private $genre;
        private DateTime $dateSortie;
        private $duree;
        private Realisateur $realisateur;
        private $casting;
        private $synopsis;

        public function __construct(Realisateur $realisateur, $titre, $genre, $dateSortie, $duree, $synopsis)
        {
            $this->titre = $titre;
            $this->genre = $genre;
            $this->dateSortie = new DateTime($dateSortie);
            $this->duree = $duree;
            $this->synopsis = $synopsis;
            $this->realisateur = $realisateur; 
            $this->realisateur->addFilm($this);
            // $this->casting = [];
            //$this->realisateur->addFilm($this);
        }

        public function getCasting() {
            return $this->casting;
        }

        // public function getNomPrenomRealisateur() {
        //     return $this->realisateur->getNom() . " " . $this->realisateur->getPrenom();
        // }

        public function getRealisateur(): Realisateur {
            return $this->realisateur;
        }

        public function getTitle() {
            return $this->titre;
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getAnneeDeSortie() {
            // return $this->dateSortie->y;
            return $this->dateSortie->format("Y");
        }

        public function getDateSortie() {
            return $this->dateSortie;
        }

        public function getDureeHrsMn() {
            return minuteToStrTime($this->duree);
        }

        public function getDuree() {
            return $this->duree;
        }

        public function getSynopsis() {
            return $this->synopsis;
        }

        public function addRole(Role $role) {
            $this->casting->addRole($role);
        }

        public function setCasting(Casting $casting) {
            $this->casting = $casting;
        }

        public function __toString()
        {
            $ret = "";
            foreach ($this->casting->getRoles() as $role) {
                $ret = $ret.$role->getRole;
            }
            return count($this->casting->getRoles()). " " . $ret;
        }
    }
?>