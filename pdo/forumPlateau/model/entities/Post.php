<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $message;
        private $user;
        // private $email;
        private $creationdate;
        private $topic;

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
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        // public function getEmail()
        // {
        //         return $this->email;
        // }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        // public function setEmail($email)
        // {
        //         $this->email = $email;

        //         return $this;
        // }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        /**
         * Get the value of topic
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of topic
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;

                return $this;
        }

        public function getCreationdate($format = "d/m/Y, H:i:s"){
            $formattedDate = $this->creationdate->format($format);
            return $formattedDate;
        }

        public function setCreationdate($date){
            $this->creationdate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of closed
         */ 
        // public function getClosed()
        // {
        //         return $this->closed;
        // }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        // public function setClosed($closed)
        // {
        //         $this->closed = $closed;

        //         return $this;
        // }
    }
