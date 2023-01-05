<?php
include 'func/func_DateTime.php';

use function PHPSTORM_META\type;

class Reservation
{
    // déclaration de propriétés composée d'objet 
    private Hotel $hotel;
    private Room $room;
    private Client $client;
    private DateTime $fromDate;
    private DateTime $toDate;

        // fonction "magique" appélé automatiquement 
        // quand on instancie un objet Reservation
        // avec new
        public function __construct(Hotel $hotel, $room, Client $client, $fromDate, $toDate)
    {
        // si la date passé en paramètre est de type string
        if (gettype($fromDate) == 'string') {
            // on crée un nouveau DateTime
            $this->fromDate = new DateTime($fromDate);
            $this->fromDate->setTime(12, 00);
            // si c'est un objet DateTime
        } elseif (gettype($fromDate) == 'object' && get_class($fromDate) == "DateTime") {
            //  on l'affecte à sa propriété
            $this->fromDate = $fromDate;
        }

        // idem avec toDate
        if (gettype($toDate) == 'string') {
            $this->toDate = new DateTime($toDate);
            $this->toDate->setTime(12, 00);
        } elseif (gettype($toDate) == 'object' && get_class($toDate) == "DateTime") {
            $this->toDate = $toDate;
        }

        // si $room passé en paramètre est de tyype int
        if (gettype($room) == 'string' || gettype($room) == 'integer') {
            // on recherche dans le tableau l'id correspondant
            // et on l'affectge à la propriété
            $this->room = $hotel->getRooms()[$room-1];
            // si c'est un objet room
        } elseif (gettype($room) == 'object' && get_class($room) == "Room") {
            // on l'affecte directement
            $this->room = $room;
        }

        // renvoi l'objet client si il existe déjà 
        // voir dans Hotel.php ligne: 81
        $clnt = $hotel->addClient($client);
        $clnt->addReservation($this);
        // met le flag reserved de la chambre à true
        $this->room->setReserved(true);
        $this->hotel = $hotel;
        $this->client = $clnt;
        $hotel->addReservation($this);
    }


    // renvoi l'objet Hotel
    public function getHotel(): Hotel
    {
        return $this->hotel;
    }

    // renvoi la chambre
    public function getRoom()
    {
        return $this->room;
    }

    // renvoi le Client
    public function getClient(): Client
    {
        return $this->client;
    }

    // renvoi la durée 
    // paramètre FACULTATIF $long 
    public function getDuration(bool $long = false)
    {
        if ($long) {
            // si $long == true 
            // alors on renvoi une version longue Ex. "du 08/11/2022  au 11/11/2022"
            return 'du ' . formatDate($this->fromDate, 'd MM-yyyy', 'fr', '/') . ' au ' . formatDate($this->toDate, 'd MM yyyy', 'fr', '/');
        } else {
            // si false renvoi le nombre de jours
            return $this->fromDate->diff($this->toDate)->days;
        }
    }

    // verifi et renvoi si la réservation est encore active donc d'actualité
    public function getReserved()
    {
        return ($this->toDate > new DateTime() && $this->room->getReserved());
    }

        // function "magique" qui est appelé automatiquement 
        // lors d'un (echo) sur l'objet ex.: (echo $reservation1)
        public function __toString()
    {
        return $this->client." ".$this->room." ".$this->hotel." ".$this->getDuration(true);
    }
}
