<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>

<body>
    <h1>Exercice 13</h1>
    <p>Créer une classe Voiture possédant les propriétés suivantes : marque, modèle, nbPortes et<br>
        vitesseActuelle ainsi que les méthodes demarrer( ), accelerer( ) et stopper( ) en plus<br>
        des accesseurs (get) et mutateurs (set) traditionnels. La vitesse initiale de chaque véhicule<br>
        instancié est de 0. Une méthode personnalisée pourra afficher toutes les informations d’un<br>
        véhicule.<br>
        <code><strong>v1 ➔</strong> "Peugeot","408",5<br>
            <strong>v2 ➔</strong> "Citroën","C4",3</code><br>
        Coder l’ensemble des méthodes, accesseurs et mutateurs de la classe tout en réalisant des jeux de<br>
        tests pour vérifier la cohérence de la classe Voiture. Vous devez afficher les tests et les éléments<br>
        suivants :<br>
        <img src="./ClassVoiture.jpg" alt="ClasseVoiture" style="
                width: auto; height: 50%;"><br>
        Bonus : ajouter une méthode ralentir(vitesse) dans la classe Voiture.
    </p>
    <h2>Resultat :</h2>

    <?php

    // classe : une classe regroupe des variable et des fonctions (Getter/Setter)
    // qui pouront être utilisées en fonction de leurs portée (héritage)

    // protected : accessible uniquement dans la classe 
    // private : accessible uniquement dans la classe et ses enfants (déscendants)
    // public accessible partout
    //  Le mot-clé static indique que l’attribut appartient à la classe elle-même
    //  et pas aux objets qui l’instancieront.

    // objet : l'objet est une instance d'une classe 

    // principe d'encapsulation : 
    // Permet de proteger l'information contenue dans un objet
    // en ne proposant que des méthodes de manipulation de cet objet.
    // l'encapsulation garantie l'intégrité des données contenue dans l'objet 
    // en proposant des méthodes d'accès aux données .

    class Voiture
    {
        // Déclaration des variables accessible 
        // uniquement dans la classe et ses déscendants pas dans l'objet 
        private string $_marque;            // de type texte contient la marque du véhicule
        private string $_modele;            // contient le Modèle
        private int $_nbPorte;              // de type entier contient le nombre de portes

        private int $_demarre = 0;          // l'état du véhicule (0 = Arrêté - 1 Démarré)
        private int $_vitesseActuelle = 0;  // sa vitesse
        private int $_voitureNum = 0;       // le numéro d'ordre de création

        private static int $_nbVoitures = 0; //attribut statique compte le nombre d'objet (voiture) créé 

        // __construct est une fonction magique qui est appellée automatiquement  "65276<Bo"
        // quand on crée un nouvel objet ( $Voiture1 = new("", "", ""))        
        public function __construct($marque, $modele, $nbPorte)
        {   // on met à jour les variables interne avec les valeurs transmise par le constructeur
            $this->_marque = $marque;               // stock la marque du véhicule
            $this->_modele = $modele;               // le modèle
            $this->_nbPorte = $nbPorte;             // le nombre de porte
            // ces variables se mettent à jour indépendament de ce qui est passé par le constructeur
            self::$_nbVoitures++;                   // incrémente le compteur interne de voiture
            $this->_vitesseActuelle = 0;            // sa vitesse est initialisée à Zéro
            $this->_demarre = 0;                    // son état aussi (0: rrêté - 1: Démarré)
            $this->_voitureNum = self::$_nbVoitures; // le numéro d'ordre de création
        }

        // Getter pour la Marque : 
        public function getMarque()
        {
            // renvoie la Marque du véhicule 
            return $this->_marque;
        }


        // renvoie la Modèle du véhicule 
        public function getModele()
        {
            return $this->_modele;
        }

        // renvoie le nombre de porte du véhicule 
        public function getnbPorte()
        {
            return $this->_nbPorte;
        }

        // Setter pour modifier la marque du véhicule
        public function setMarque($value)
        {   // Applique les changements
            $this->_marque = $value;
        }

        // Setter pour modifier le modèle du véhicule
        public function setModele($value)
        {
            $this->_modele = $value;
        }

        // Setter pour modifier le nombre de porte du véhicule
        public function setnbPorte($value)
        {
            $this->_nbPorte = $value;
        }

        // fonction qui renvoie l'état du véhicule (Démarré ou non)
        // sous la forme d'un boolean
        public function estDemarre(): bool
        {
            return ($this->_demarre == 1);
        }

        //  Vérifie que le véhicule est arrêté avant de le démmarer
        //  dans le cas contraire il en informe l'utilisateur
        public function demarrer()
        {
            if ($this->estDemarre()) {
                echo "Le véhicule " . $this->_marque . " " . $this->_modele . " est déjà Démarré !<br>";
            } else {
                echo "Le véhucule " . $this->_marque . " " . $this->_modele . " démarre<br>";
                $this->_demarre = 1;
            }
        }

        // Accélère le véhicule de ($value)
        public function accelerer(int $value)
        {   // si le véhicule n'est pas démarré 
            // on informe l'utilisateur de l'état et de la marche à suivre pour y arriver
            if (!$this->estDemarre()) {
                echo "Le véhicule " . $this->_marque . " " . $this->_modele . " veut accélérer de " . $value . "<br>
                Pour accélerer il faut démarrer le véhicule " . $this->_marque . " " . $this->_modele . " !<br>";
            } else {  // on informe l'utilisateur que l'accélération est bien prise en compte
                $this->_vitesseActuelle = $this->_vitesseActuelle + $value;
                echo "Le véhicule " . $this->_marque . " " . $this->_modele . " accélère de " . $value . "<br>";
            }
        }

        //ralenti le Véhicule de ($value)
        public function ralentir(int $value)
        {
            echo "Le véhicule " . $this->_marque . " " . $this->_modele . " veut ralentir de "  . $value . "<br>";
            // si le véhicule n'est pas démarré 
            // on informe l'utilisateur de l'état et de la marche à suivre pour y arriver
            if (!$this->estDemarre()) {
                echo "Pour ralentir il faut démarrer le véhicule " . $this->_marque . " " . $this->_modele . " !<br>";
            // si la vitesse actuelle est de Zéro 
            } elseif ($this->_vitesseActuelle <= 0) {   
                echo "Pour ralentir le véhicule doit avoir une vitesse suppérieure à " . $this->_vitesseActuelle . " !<br>";
            } else 
            {
                $this->_vitesseActuelle = $this->_vitesseActuelle - $value;
                // controle les limites basse
                if ($this->_vitesseActuelle < 0) {
                    $this->_vitesseActuelle = 0;
                }
                echo "Le véhicule " . $this->_marque . " " . $this->_modele . " ralenti de "  . $value . "<br>";
                echo "Sa nouvelle vitesse est de " . $this->_vitesseActuelle . " km/h<br>";
            }
        }


        // permet de stopper le véhicule et
        // par conscéquent sa vitesse est portée à zéro km / h et son état à Zéro
        public function stopper()
        {   // si le véhicule est déjà arrêté on en informe l'utilisateur 
            if (!$this->estDemarre()) {
                echo "Le véhicule N° " . $this->_voitureNum . " est déjà Stoppé !<br>";
            } else {
                echo "Le véhucule " . $this->_marque . " " . $this->_modele . " est stoppé<br>";
                $this->_vitesseActuelle = 0;
                $this->_demarre = 0;
            }
        }

        // cette fonction est accèssible depuis la classe
        // et compte le nombre d'objet de classe voiture créé
        public static function nbVoiture() //méthode statique
        {
            echo self::$_nbVoitures;
        }

        // fonction qui renvoie la vitesse actuelle du véhicule
        public function vitesseActuelle()
        {
            echo "La vitesse du véhicule " . $this->_marque . " " . $this->_modele  . " est de " . $this->_vitesseActuelle . " km/h<br>";
        }

        // rajouter une fonction to string et définition d'une méthode magique 
        // une fonction magique est une fonction qui est précédée par 2 "underscore (__)" et 
        // qui s'exécute automatiquement sans avoir a faire appel à elle. 
        public function __toString()
        {
            $status = ($this->estDemarre() ? " Démarré" : " Arrêté");
            return "Info véhicule : " . $this->_voitureNum . "<br>
                        Nom et Modèle du véhicule : " . $this->_marque . " " . $this->_modele . "<br>
                        Nombre de portes : " . $this->_nbPorte . "<br>
                        Le véhicule " . $this->_marque . " est" . $status . "<br>
                        Sa vitesse actuel est de : " . $this->_vitesseActuelle . " km/h<br><br>";
        }
    }

    $V1 = new Voiture("PEUGEOT", "408", "5");
    $V2 = new Voiture("CITROËN", "C4", "3");
    $V1->demarrer();
    $V1->accelerer(50);

    $V2->demarrer();
    $V2->stopper();
    $V2->accelerer(20);
    $V1->vitesseActuelle();
    $V2->vitesseActuelle();
    $V2->ralentir(20);

    echo "<br>";
    echo $V1;
    echo $V2;


    ?>
</body>

</html>