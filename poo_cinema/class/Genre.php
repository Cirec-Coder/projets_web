<?php
class Genre {
    private $genderName;
    private array $films;

    const GENRE_SF = "Sience-Fiction";
    const GENRE_COMEDY = "Comédie";
    const GENRE_ACTION = "Action";
    const GENRE_AVENTURE = "Aventure";
    const GENRE_HORROR = "Horreur";
    const GENRE_COMEDY_MUSICALE = "Comédie-Musicale";
    const GENRE_POLICE = "Policier";
    const GENRE_THRILLER = "Thriller";

    const ARRAY_OF_GENRE = [self::GENRE_SF, self::GENRE_COMEDY, self::GENRE_ACTION, self::GENRE_AVENTURE, self::GENRE_COMEDY_MUSICALE, self::GENRE_POLICE, self::GENRE_HORROR, self::GENRE_THRILLER];

    public function __construct($genderName)
    {
        $this->setGenderName($genderName);
    }

    public function setGenderName($genre) {
        if (in_array($genre, self::ARRAY_OF_GENRE)) {
            $this->genderName = $genre;
        }
    }

    public function getGenderName() {
        return $this->genderName;
    }

    public function addFilm(Film $film)
    {
        $this->films[] = $film;
    }

    public function listFilms() {
        echo "<b>Film de Genre :</b><i>".$this."</i><br>";
        foreach ($this->films as $film ) {
            echo "&emsp;".$film."<br>";
        }
    }

    static function getGenders(): array {
        return self::ARRAY_OF_GENRE;
    }

    public function __toString()
    {
        return $this->genderName;
    }
}
