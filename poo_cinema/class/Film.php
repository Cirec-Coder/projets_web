<?php
    // classe Film
    class Film {
        // définition de propriétés 
        private $titre;                     // string titre
        private Genre $genre;               // objet de classe Genre
        private DateTime $dateSortie;       // objet de classe DateTime
        private $duree;                     // int durée en mn
        private Realisateur $realisateur;   // objet de classe Realisteur
        private array $castings;            // tableau d'objet de classe Casting
        private $synopsis;                  //


        /*
            permet d'initialiser l'objet que l'on vient d'instancier
            la fonction __construct est appellé automatiquement par "new"
            ce qui la place dans les fonctions dites "magique"
        */
        public function __construct(Realisateur $realisateur, $titre, Genre $genre, $dateSortie, $duree, $synopsis)
        {
            // initialise les données avec les valeurs passées dans le constructeur
            $this->titre = $titre;
            $this->genre = $genre;
            // converti la date en objet DateTime
            $this->dateSortie = new DateTime($dateSortie);
            $this->duree = $duree;
            $this->synopsis = $synopsis;
            $this->realisateur = $realisateur; 
            // on en profite pour ajouter le film courant
            // au réalisateur
            $this->realisateur->addFilm($this);
            // initialise le tableau castings à vide
            $this->castings = [];
            // ajoue le film à l'objet Genre
            $this->genre->addFilm($this);
        }

        // renvoi le réalisateur du film
        public function getRealisateur(): Realisateur {
            return $this->realisateur;
        }

        // met à jour le réalisateur avec la valeur passée en paramètre 
        public function setRealisateur(Realisateur $realisateur)  {
            $this->realisateur = $realisateur;
        }

        // renvoi le titre du film
        public function getTitle() {
            return $this->titre;
        }

        // met à jour le titre avec la valeur passée en paramètre 
        public function setTitle($title) {
            $this->titre = $title;
        }

        // renvoi l'objet Genre
        public function getGenre(): Genre {
            return $this->genre;
        }

        // met à jour le genre avec la valeur passée en paramètre 
        public function setGenre(Genre $genre) {
            $this->genre = $genre;
        }

         // renvoi l'année de sortie au format string 
         public function getAnneeDeSortie() {
            return $this->dateSortie->format("Y");
        }

        // renvoi la date de sortie au format objet DateTime 
        public function getDateSortie(): DateTime {
            return $this->dateSortie;
        }

        // renvoi la date de sortie au format string 
        public function getStrDateSortie(): string {
            return formatDate($this->dateSortie, 'd MMMM yyyy');
        }

        // met à jour la date de sortie avec la valeur passée en paramètre 
        public function setDateSortie($dateSortie) {
            $this->dateSortie = $dateSortie;
        }

        // renvoi un string contenant la durée en H:MN 
        public function getDureeHrsMn(): string {
            return minuteToStrTime($this->duree);
        }

        // renvoi la durée au format int 
        public function getDuree(): int {
            return $this->duree;
        }

        // met à jour la durée avec la valeur passée en paramètre 
        public function setDuree($duration) {
            $this->duree = $duration;
        }

        // renvoi le synopsis du film au format string
        public function getSynopsis(): string {
            return $this->synopsis;
        }

        // met à jour le synopsys avec la valeur passée en paramètre 
        public function setSynopsis($synopsis) {
            $this->synopsis = $synopsis;
        }

        public function addCasting(Casting $casting)
        {
            $this->castings[] = $casting;
        }

        // renvoi le tableau d'objets Casting
        public function getCastings()
        {
            return $this->castings;
        }

        // affiche (echo) le casting du film
        public function showCasting() {
            echo "<br><b>Casting du Film : </b>" . 
                $this->titre . " <b>de :</b><i> " .
                $this->realisateur . "</i><br>";
                foreach ($this->castings as $casting) {
                    echo $casting;
                }
        }

        // renvoi un string contenant
        // Année de sortie Durée en mn et h:mn:s
        // et le genre
        public function getShortInfo() {
            return " <b>année de sortie : </b>" .$this->getAnneeDeSortie() . " <b>durée : </b>" . 
                    $this->duree . " mn (" . 
                    $this->getDureeHrsMn() . ") <b>genre :</b> " . 
                    $this->genre;
        }

        // renvoi le titre du film 
        // + le contenu de getShortInfo();
        public function getInfo() {
            return $this->titre . " " . 
                    $this->getShortInfo();
        }

        // fonction "magique" apppelée 
        // automatiquement lors d'un (echo) sur un objet Film
        public function __toString()
        {
            return  $this->getInfo(). " <b>de :</b><i> " . 
                    $this->realisateur . "</i><br>&emsp;&emsp;&emsp;<b>Synopsis :</b> " . 
                    $this->synopsis;
        }
    }
