<?php
    class Acteur extends Personne {
        private array  $roles;

        public function __construct($nom, $prenom, $sex, $dateNaissance)
        {
            parent::__construct($nom, $prenom, $sex, $dateNaissance);
            $this->roles = [];
        }

        public function addRole(Role $role) {
            $this->roles[] = $role;
        }

        public function getRoles() {
            return $this->roles;
        }

        public function filmographie() {
            echo $this->getPrenom()." ".$this->getNom()."<br>";
            foreach ($this->roles as $role) {
                echo $role->getRole()."<br>";
            }
        }
        public function __toString()
        {
            
            $ret = "";
            foreach ($this->roles as $role) {
                $ret = $ret. $role->getRole();
            }
            return $ret;
        }
    }
?>
