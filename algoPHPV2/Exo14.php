<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exercices PHP-2 MMU V1.0</title>
    </head>
    <body>
        <h1>Exercice 14</h1>
        <p>Créer une classe Voiture possédant 2 propriétés (marque et modèle) ainsi qu’une classe VoitureElec<br/>
            qui hérite (extends) de la classe Voiture et qui a une propriété supplémentaire (autonomie).<br/>
            Instancier une voiture « classique » et une voiture « électrique » ayant les caractéristiques<br/>
            suivantes :<br/>
            <code>Peugeot 408 : $v1 = new Voiture("Peugeot","408");<br/>
            BMW i3 150 : $ve1 = new VoitureElec("BMW","I3",100);<br/>
            Votre programme de test devra afficher les informations des 2 voitures de la façon suivante :<br/>
            echo $v1->getInfos()."&LessLess;br/&GreaterGreater;";<br/>
            echo $ve1->getInfos()."&LessLess;br/&GreaterGreater;";<br/><code>
        </p>
        <h2>Resultat :</h2>

        <?php

// use Voiture as GlobalVoiture;
            // classe Voiture de "base"
            // contient deix propriétés Marque & Modèle
            class Voiture {
                private string $Marque;
                private string $modele;

                public function __construct($marque, $modele)
                {
                    $this->_marque = $marque;
                    $this->_modele = $modele;
                }

                public function getMarque()
                {
                    return $this->_marque;
                }

                public function getModel()
                {
                    return $this->_modele;
                }
                
                public function setMarque($value)
                {
                    $this->_marque = $value;
                }
                
                public function setModele($value)
                {
                    $this->_modele = $value;
                }

                public function getInfos()
                {
                    echo "Véhicule thermique ". $this->_marque .  " " .$this->_modele . "<br>";
                }
            }

            // classe Voiture Electrique
            // qui hérite (extends) de Voiture
            // avec une propriété supplémentaire "autonomie" 
            class VoitureElec extends Voiture {
                private int $autonomie;

                public function __construct($marque, $modele, $autonomie)
                {
                    // $this->_marque = $marque;
                    // $this->_modele = $modele;
                    parent::__construct($marque, $modele);
                    $this->_autonomie = $autonomie;
                }

                public function getInfos()
                {
                    echo "Véhicule éléctrique ". $this->_marque .  " " .$this->_modele . " d'une autonomie de : ".$this->_autonomie." km<br>";
                }
            }


            $v1 = new Voiture("Peugeot","408");
            $ve1 = new VoitureElec("BMW","I3",100);

            $v1->getInfos();
            $ve1->getInfos();

        ?>
    </body>
</html>