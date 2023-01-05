<?php
// classe Country (pays)
// qui regroupe toutes les équipes du pays
class Country
{
    private $name;          // Nom du pays
    private array $clubs;   // Tableau de Clubs (objet Club)

    // constructeur appelé automatiquement 
    // quand on instancie un objet Country (new Country)
    public function __construct($name)
    {
        // initialise les propriétés avec les valeurs passé en paramètre
        $this->name = $name;
        $this->clubs = [];
    }

    // retourne le nom du pays
    public function getName()
    {
        return $this->name;
    }

    // ajoute un club (passé en paramètre)
    // au tableau de Clubs
    public function addClub(Club $club)
    {
        $this->clubs[] = $club;
    }
    
    // retourne le tableau de Clubs
    public function getClubs()
    {
        return $this->clubs;
    }

    // Liste toutes les équipe du pays
    public function listClub()
    {
        echo "<b>Liste des équipes de :</b> $this->name <br>";
        foreach ($this->clubs as $key => $value) {
            echo  "&emsp;" . $value->getName() . " " . $value->getCity() . "<br>";
        }
    }
}