
<?php
    class Titulaire {
        private $nom;
        private $prenom;
        private DateTime $dateNaissance; 
        private $ville;
        private array $comptes;

        public function __construct($nom, $prenom, $dateNaissance, $ville)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->dateNaissance = new DateTime($dateNaissance);
            $this->ville = $ville; 
            $this->comptes = [];
        }

        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function getDateNaissance() {
            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
            $formatter->setPattern('d MMMM yyyy');
            $strDate = $formatter->format($this->dateNaissance);
            return $strDate;
        }

        public function getVille() {
            return $this->ville;
        }

        public function setVille($value) {
            $this->ville = $value;
        }

       public function addCompte(Compte $compte) {
            $this->comptes[] = $compte;
        }

        public function getCompte($libelle): Compte {
            foreach ($this->comptes as $compte) {
                if ($libelle == $compte->getLibelle()) {
                    return $compte;
                }
            }
            return null;
        }

        public function getInfosCompte($libelle) {
            echo "<b>Informations sur le compte</b> $libelle <b>de :</b> ";
            echo $this->getNomPremon()."<br>";
            $compte = $this->getCompte($libelle);
            if (!$compte == null) {
                echo $compte->getInfos()."<br>";
            } else {
                echo "Le compte : $libelle n'existe pas";
            }
        }

        public function getAge() {
            return $this->dateNaissance->diff(new DateTime("now"))->y;
        }

        public function getNomPremon() {
            return $this->getPrenom()." ".$this->getNom(). " ";
        }

        public function checkLimit(Compte $compte, $montant): bool {
            $ret = $montant > 0;
            if (!$ret) {
                $ret = ($compte->getsolde() + $montant) > 0 ;
            }
            return $ret;
        }

        public function virementInterne($compteSource, $compteDestination, $montant) {
            $source = $this->getCompte($compteSource);
            $dest = $this->getCompte($compteDestination);
            if (!($source == null and $dest == null)) {
                echo "<b>Virement du compte :</b> ".$source->getLibelle() ." <b>de : </b>".$this->getNomPremon()." <br><b>vers le compte :</b> ".$dest->getLibelle() . " <b>de :</b> ".$this->getNomPremon(). " <br><b>d'un montant de :</b> $montant <b> €</b><br><br>";

                if (!$this->checkLimit($source, -$montant)) {
                    echo "<b>Le compte : </b>".$source->getLibelle() ." <b>de : </b>".$this->getNomPremon()."<br><b style='color: red;'><u> dispose d'un montant insuffisant pour effectuer la transaction</u></b><br>";
                    echo "<b>Solde du compte : </b><span style='color: green;'>".$source->getsolde()." </span><b>".$source->getDevise()."  Montant de la transaction : </b><span style='color: red;'>".abs($montant)." </span><b>€</b><br>";
                    echo "<b>Transaction Annulée : </b><br><br>";
                    return ;
                
                }
                $source->setAmount(-$montant);
                $dest->setAmount($montant);
            }
        }
 
        // renvoi un récapitulatif de tous les comptes d'un titulaire
        public function getInfos() {
            echo "<u><b>Récapitulatif des Comptes de :</b></u><br>";
            echo "<b>Nom :</b> $this->nom <br><b>Prénom :</b> $this->prenom <br><b>Age :</b> ".
            $this->getAge(). " ans<br><b>Ville :</b> $this->ville<br>&emsp;<b>Compte(s) :</b> <br>";

            foreach ($this->comptes as $compte) {   
                echo $compte->getInfos()."<br>";
            }
        }
    }
?>