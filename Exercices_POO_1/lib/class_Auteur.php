<?php
    // Classe Auteurs :
    // le non le prénom de l'auteur.
    // et une collection de livres 
    final class Auteur
    {
        private string $nom;
        private string $prenom;
        private array $livres = [];

        public function __construct($prenom, $nom, $livres =  [], $sorted = false)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->livres = [];
            // si des livres sont passé en paramètre
            if (count($livres) > 0 ) { 
                // si $sorted = true
                if ($sorted) {
                    // alors trie le tableau
                    asort($livres);
                } 
                foreach ($livres as $livre) {
                    // et on les ajoutes
                    new Livre($this, $livre[0], $livre[1], $livre[2], $livre[3]);
                }
            }
        }


        public function getNom()
        {
            return $this->nom;
        }

        public function getPrenom()
        {
            return $this->prenom;
        }
        public function getLivre($titre)
        {
            foreach ($this->livres as $livre) {
                if (mb_strtoupper($livre->getTitre()) == mb_strtoupper($titre)) {
                    return $livre;
                }
            }
            echo "<br>Le livre " . $titre . " de $this ne figure pas dans la liste !";
            // permet d'éviter une erreur d'accès 
            // si le livre $titre n'existe pas
            return $livre = new Livre($this, "", 0, 0, 0);
        }
 
        public function addLivre($livre) {
            $this->livres[] = $livre;
        }

        public function __toString()
        {
            return $this->getPrenom() . " " . $this->getNom();
        }

        public function afficherBibliographie()
        {
            $ret = "<h2>Livres de " . $this . "</h2>";
            foreach ($this->livres as $livre) {
                $ret = $ret . $livre;
            }
            return $ret;
        }
    }
?>