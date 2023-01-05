<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudo;
        private $email;
        private $password;
        private $inscriptiondate;
        private $accountstatus;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getInscriptiondate($format = "d/m/Y, H:i:s"){
            $formattedDate = $this->inscriptiondate->format($format); // , H:i:s
            return $formattedDate;
        }

        public function setInscriptiondate($date){
            $this->inscriptiondate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of accountstatus
         */ 
        public function getAccountstatus()
        {
                return $this->accountstatus;
        }

        /**
         * Set the value of accountstatus
         *
         * @return  self
         */ 
        public function setAccountstatus($accountstatus)
        {
                $this->accountstatus = $accountstatus;

                return $this;
        }

        public function hasRole($status)
        {
                return $this->getAccountstatus() == $status;
        }

        public function getFrendlyRoleName()
        {
                $names = array("ROLE_USER" => "Membre", "ROLE_ADMIN" => "Administrateur");
                return $names[$this->getAccountstatus()];
        }

        public function __toString()
        {
                return $this->getPseudo();
        }
    }
