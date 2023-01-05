<?php
    class Casting {
        private Acteur $acteur; 
        private Film $film;
        private Role $role;

        public function __construct(Film $film, Role $role, Acteur $acteur)
        {
            $this->acteur = $acteur;
            $this->film = $film;
            $this->role = $role;
            $this->role->addCasting($this);
            $this->acteur->addCasting($this);
            $this->film->addCasting($this);
            $this->acteur->addRole($role, $film);
        }


        public function getRole() {
            return $this->role;
        }

        public function getFilm(): Film {
            return $this->film;
        }

        public function getActeur(): Acteur {
            return $this->acteur;
        }

        public function setRole(Role $role) {
            $this->role = $role;
        }

        public function setFilm(Film $film) {
            $this->role = $film;
        }

        public function setActeur(Acteur $acteur) {
            $this->role = $acteur;
        }

        public function __toString()
        {
            return "&emsp;<i>".$this->acteur . " </i><b>dans le role de :</b> <i>" . $this->role."</i><br>";
        }
    }
?>