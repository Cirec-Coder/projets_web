<?php
//   include_once("../lib/class_Role.php");
    class Casting {
        // private Film $film;
        private $roles = [];

        public function __construct(Film $film)
        {
            $this->roles = [];
            // $this->film = $film;
            // $this->film->setCasting($this);
            $film->setCasting($this);
        }

        public function getRoles() {
            return $this->roles;
        }

        public function addRole(Role $role) {
            $this->roles[] = $role;
        }

        public function __toString()
        {
            $ret = "";
            foreach ($this->roles as $role) {
                $ret = $ret.$role->getRole();
            }
            return $ret;
        }

    }
?>