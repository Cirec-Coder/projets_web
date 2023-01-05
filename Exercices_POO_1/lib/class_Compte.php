<?php
    class Compte {
        private $libelle;
        private $solde;
        private $devise;
        private Titulaire $titulaire;

        const COMPTE_COURANT = "Courant";
        const COMPTE_LIVRET_A = "Livret A";
        const COMPTE_PRO = "Entreprise";

        public function __construct(Titulaire $titulaire, $libelle, $solde, $devise)
        {
            $this->titulaire = $titulaire;
            $this->setLibelle($libelle);
            $this->solde = $solde;
            $this->devise = $devise;
            $titulaire->addCompte($this);
        }


        public function setLibelle($libelle) {
            if (in_array($libelle, [self::COMPTE_COURANT, self::COMPTE_LIVRET_A, self::COMPTE_PRO])) {
                $this->libelle = $libelle;
            }
        }
        
        public function getLibelle() {
            return $this->libelle;
        }
        
        public function getsolde() {
            return $this->solde;
        }

        public function setSolde($value) {
            $this->solde = $value;
        }

        public function getDevise() {
            return $this->devise;
        }

        public function setAmount($amount) {
            $this->solde = $this->solde + $amount;
        }
        
        public function getInfos() {
            echo "&emsp;&emsp;<b>Libellé :</b> $this->libelle<br>&emsp;&emsp;<b>Solde :</b> $this->solde $this->devise<br>";
        }
    }
?>