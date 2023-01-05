<?php
    // classe Hotel
    class Hotel {
        // déclaration de propriétés 
        private $name;                  // nom de l'hotel
        private $roadNum;               // n° de rue
        private $road;                  // rue
        private $zipCode;               // code postal
        private $city;                  // ville
        private $nbStars;               // Nbr Étoiles
        private array $rooms;           // tableau de chambres
        private array $reservations;    // tableau de reservations
        private array $clients;         // tableau de clients

        // fonction "magique" appélé automatiquement 
        // quand on instancie un objet personne
        // avec new
        public function __construct($name = '', $roadNum = '', $road = '', $zipCode  = '', $city = '', $nbStars = 0)
        {
            // initialise l'objet avec les valeurs passé au constructeur
            $this->name = $name;
            $this->roadNum = $roadNum;
            $this->road = $road;
            $this->zipCode = $zipCode;
            $this->city = $city;
            $this->nbStars = $nbStars;
            $this->rooms = [];
            $this->reservations = [];
            $this->clients = [];
        }

        // renvoi le nom
        public function getName()
        {
            return $this->name;
        }

        // renvoi le numéro de rue
        public function getRoadNum()
        {
            return $this->roadNum;
        }

        // renvoi le nom de la rue
        public function getRoad()
        {
            return $this->road;
        }

        // renvoi l'adresse
        public function getAddress()
        {
            return "$this->roadNum $this->road $this->zipCode $this->city";
        }        

        // renvoi le code postal
        public function getZipCode()
        {
            return $this->zipCode;
        }        

        // renvoi la ville
        public function getCity()
        {
            return $this->city;
        }        

        // renvoi le nombre d'étoile
        public function getNbStar()
        {
            return $this->nbStars;
        }

        // renvoi le nombre d'étoile sous forme de chaine de caractères
        // Ex. si nbStars = 4 getStrNbStar() renverra "****"
        public function getStrNbStar()
        {
            return str_repeat('*', $this->getNbStar());
        }

        // ajoute un client au tableau de clients 
        // seulement si il n'existe pas déjà 
        public function addClient(Client $client)
        {
            // parcour le tableau de clients
            foreach ($this->clients as $clnt) {
              if (strtoupper($clnt) == strtoupper($client)) {
                // si le client existe déjà on le renvoi
                return $clnt;
                break;
              }  
            }
            // si il n'existe pas on l'ajoute et on le renvoi
            $this->clients[] = $client;
            return $client;
        }

        // renvoi le tableau de client
        public function getClients()
        {
            return $this->clients;
        }

        // ajoute une chambre au tableau de chambre "rooms"
        public function addRoom(Room $room)
        {
            $this->rooms[] = $room;
        }


        // renvoi le tableau de chambres "rooms"
        public function getRooms()
        {
            return $this->rooms;
        }

        // renvoi le nombre de chambre
        public function getNbRoom()
        {
            return count($this->rooms);
        }

        // ajoute une reservation (passée en paramètre) au tableau de reservations
        public function addReservation(Reservation $reservation)
        {
            $this->reservations[] = $reservation;
        }

        // renvoi le tableau de réservations
        public function getReservations()
        {
            return $this->reservations;
        }

        // renvoi le nombre de réservations
        public function getNbReservation()
        {
            $ret = 0;
            foreach ($this->getReservations() as $reservation) {
                if ($reservation->getReserved()) {
                    $ret++;
                }
                
            }
            return $ret;
        }

        // function qui trouve une chambre libre selon les critères passés en paramètre
        public function findFreeRoom(int $nbPers, int $nbBed, bool $wifi): Room
        {
            foreach ($this->rooms as $room) {
                // recherche avec critères strict
                if (!$room->getReserved() && $room->getNbPlace() == $nbPers && $room->getNbBed() == $nbBed && $room->getWifi() == $wifi) {
                    return  $room;
                    break;
                }
            }
            // si pas trouvé
            // recherche avec recherche strict sur le nom et le wifi
            // mais avec plus de lits
            foreach ($this->rooms as $room) {
                if (!$room->getReserved() && $room->getNbPlace() == $nbPers && $room->getNbBed() >= $nbBed && $room->getWifi() == $wifi) {
                    return  $room;
                    break;
                }
            }
                // si pas trouvé
            // recherche avec recherche strict sur le nom
            // mais avec plus de lits
            // ou pas de wifi
            foreach ($this->rooms as $room) {
                if (!$room->getReserved() && $room->getNbPlace() >= $nbPers && $room->getNbBed() >= $nbBed && $room->getWifi() == $wifi) {
                    return  $room;
                    break;
                }
            }
        }

        // function permettant de verifier la validité
        // des reservations 
        // si elle n'est plus valide elle est retirée du tableau
        public function checkResevations()
        {
            foreach ($this->reservations as $idx => $reservation) {
                if (!$reservation->getReserved()) {
                    $reservation->getRoom()->setReserved(false);
                    unset($this->reservations, $idx);
                }
            }
        }

        public function __toString()
        {
            return $this->getName() . " " . str_repeat('*', $this->getNbStar()) . " " . $this->getAddress();
        }
    }




?>
