<?php
    class Role {
        private $role;
         private Casting $casting;
        private Film $film;

        public function __construct(Film $film, Casting $casting, Acteur $acteur, $role)
        {
            $this->film = $film;
            $this->role = $role;
            $this->casting = $casting;
            // $this->casting->addRole($this);
            $acteur->addRole($this);
            $this->film->getRealisateur()->addActeur($acteur);
        }

        public function getRole() {
            return $this->role. " dans " . $this->film->getTitle();
        }
    }
?>