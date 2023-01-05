<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 01</title>
</head>
<style>
    h3 {
        text-decoration: underline;
    }
</style>
<body>

<?php 
// echo "Hello World!!<br>";
echo "<h3>Exo 01 :</h3>";
$phrase = "Notre formation DL commence aujourd'hui";

echo "La phrase &LessLess; ".$phrase." &GreaterGreater; contient ".mb_strlen($phrase)." caractères.<br>";

echo "<h3><br>Exo 02 :</h3>";
//$nmots = explode(" ", $phrase);
// echo "La phrase &LessLess; ".$phrase." &GreaterGreater; contient ".count($nmots)." mots.<br>";
// version simplifié utilisant str_word_count
echo "La phrase &LessLess; ".$phrase." &GreaterGreater; contient ".str_word_count($phrase, 0)." mots.<br>";

echo "<h3><br>Exo 03 :</h3>";
echo $phrase."<br>";
echo str_replace("aujourd'hui", "demain", $phrase)."<br>";

echo "<h3><br>Exo 04 :</h3>";
$phrase = "Engage le jeu que je le gagne";
$phrase2 = strtolower(str_replace(" ", "", $phrase));

$reversephrase = strrev($phrase2);
    if ($phrase2 == $reversephrase) {
            echo "La phrase &LessLess; ".$phrase." &GreaterGreater; est un palindrome.<br>";
        } else {
            echo $reversephrase;
        }

echo "<h3><br>Exo 05 :</h3>";
$valfranc = 100;
$valeuro = $valfranc / 6.55957;
echo "Montant en Franc : ".$valfranc."<br>";
echo $valfranc." francs = ".round($valeuro, 2)." €<br>";

echo "<h3><br>Exo 06 :</h3>";
$prixUnitaire = 9.99;
$quantite = 5;
$tva = 0.2;
$total = ($prixUnitaire + ($prixUnitaire * $tva)) * $quantite;
// avec factorisation
$total = $prixUnitaire * $quantite * (1 + $tva);

echo "Prix unitaire de l'article : ".$prixUnitaire."<br>
    Quantité : ".$quantite."<br>
    Taux de TVA : ".$tva."<br>
    Le montant de la facture à régler est de : ".$total." €<br>";

echo "<h3><br>Exo 07 :</h3>";
$age = 12;
    switch ($age) {
        case ($age > 5 and $age < 8):
            echo "L’enfant qui a ".$age." ans appartient à la catégorie « Poussin »";
            break;
        case ($age > 7 and $age < 10):
            echo "L’enfant qui a ".$age." ans appartient à la catégorie « Pupille »";
            break;
        case ($age > 9 and $age < 11):
            echo "L’enfant qui a ".$age." ans appartient à la catégorie « Minime »";
            break;
        case ($age > 11):
            echo "L’enfant qui a ".$age." ans appartient à la catégorie « Cadet »";
            break;
        default :
            echo "L’enfant qui a ".$age." ans appartient à aucune catégorie";
    }
        
echo "<h3><br>Exo 08 :</h3>";
    // fonction qui affiche une table de  multiplication
function tableMult($value)
{
    echo "Table de ".$value." :<br>";
    for ($i = 1; $i <= 10; $i++) {
        echo $i." * ".$value." = ".($value * $i)."<br>";
    }
        // echo $value;
}

function tableMult2($value)
{
    $i = 1;
    echo "<br>Table de ".$value." :<br>";
    while($i <=  10) {
        echo $i." * ".$value." = ".($value * $i)."<br>";
        $i++;
    }
        // echo $value;
}

$avalue = 8;
tableMult($avalue);
        
$avalue = 3;
tableMult2($avalue);
        
echo "<h3><br>Exo 09 :</h3>";

function estImposable($sex, $age): bool {
    $s = strtoupper($sex)[0];
    switch($s) {
    case('F' and $age >18 and $age < 35):
        // echo "Femme";
        return true;

    case('H' and $age > 20):
        // echo "Homme";
        return true;

    default: return false;
    }
    return false;
}


$sex = 'f';
$age = 20;
echo "Age : ".$age."<br>Sex : $sex<br>";
    if (estImposable($sex, $age)) {
        echo "La personne est imposable.";
    } else {
        echo "La personne est non imposable.";
    }

// function test(bool $param) {
//     echo var_dump($param);
// }
// test(true);

echo "<h3><br>Exo 10 :</h3>";
function s(int $value): string {
    if ($value > 1) {
        return 's';
    } else {
        return '';
    }
}
$mp = 152;
$mv = 200;
$rp = abs($mp - $mv);

$nb10 = intdiv($rp, 10);
$nb5 = intdiv(fmod($rp, 10), 5);
$np2 = intdiv(fmod($rp, 10) - $nb5 * 5, 2);
$np1 = fmod($rp, 10) - $nb5 * 5 - $np2 * 2;

echo "Montant à payer : $mp €<br>Montant versé : $mv €<br>Reste à payer : $rp €<br>***************************************************************************<br>";
echo "Rendue de monnaie :<br>";
echo "$nb10 billet".s($nb10)." de 10 € - $nb5 billet".s($nb5)." de 5 € $np2 piece".s($np2)." de 2 € $np1 piece".s($np1)." de 1 €"; 
;

echo "<h3><br>Exo 11 :</h3>";
$voitures = array('Peugeot', 'Renault', 'BMW', 'Mercedes');
echo "il y a ".count($voitures)." marques de voitures dans le tableau :";
echo "<ul>";
foreach($voitures as $voiture) {
echo "<li>".$voiture."</li>";
}
unset($voiture);
echo "</ul>";

echo "<h3><br>Exo 12 :</h3>";
// $arrayNom = array("Michaël" => "FRA", "Virgile" => "ESP", "Marie-Claire" => "ENG");
$arrayNom = array("FRA" => "Michaël", "ESP" => "Virgile", "ENG" => "Marie-Claire");
$arrayLng = array("FRA" => "Salut", "ESP" => "Hola", "ENG" => "Hello");

foreach(array_keys($arrayNom) as $name) {
    echo "{$arrayLng[$name]} {$arrayNom[$name]}<br>";
}
echo "<br>";
asort($arrayNom);
foreach(array_keys($arrayNom) as $name) {
    echo "{$arrayLng[$name]} {$arrayNom[$name]}<br>";
}

echo "<h3><br>Exo 13 :</h3>";
$notes = array(10, 12, 8, 19, 3, 16, 11, 13, 9);
$moyenne = 0;
echo "Les notes obtenues par l'élève sont : ";
foreach($notes as $note){
    // $moyenne += $note;
    echo $note."&nbsp;&nbsp;";
}
// $moyenne = $moyenne / count($notes);
// echo "<br>Sa moyenne générale est donc de : ".round($moyenne, 2);
// array_sum permet d'additionner les valeurs contenues dans le tableau
$moyenne = round(array_sum($notes) / count($notes), 2);
echo "<br>Sa moyenne générale est donc de : ".$moyenne;


echo "<h3><br>Exo 14 :</h3>";
$now = new DateTime(); // date d'aujourd'hui
$dateNaissance = new DateTime("1985-014-17"); // date de naissance 
$diff = $dateNaissance->diff($now); // diff calcule la différence entre 2 Dates
echo "Age de la personne ".$diff->y." ans ".$diff->m." mois ".$diff->d." jours<br>";

// $d=mktime(0, 0, 0, 5, 21, 2018);
// echo "Date courante : " . date("d/m/Y", $d)."<br>";
// $b=mktime(0, 0, 0, 1, 17, 1985);
// echo "Date de naissance : " . date("d/m/Y", $b)."<br>";
// echo "Age de la personne : ".(date("Y", $d)-date("Y", $b))." ans ".(date("m", $d)-date("m", $b))." mois ".(date("d", $d)-date("d", $b))." jours<br>";


echo "<h3><br>Exo 15 :</h3>";
class Personne {
    private string $nom;
    private string $prenom;
    private DateTime $dateNaissance;
    public function __construct($nom, $prenom, $dateNaissance)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = new DateTime($dateNaissance);
    }
    public function getName()
    {
        return $this->nom;
    }
    public function getFirstName()
    {
        return $this->prenom;
    }
    public function getAge()
    {
        $now = new DateTime();
        $diff = $this->dateNaissance->diff($now);
        return $diff->y." ans";
    }
    public function __toString() {
        return $this->prenom." ".$this->nom." a ".$this->getAge();
    }
}

$p1 = new Personne("DUPONT","Michel", "1980-02-19");
$p2 =new Personne("DUCHEMIN","Alice", "1985-01-17");

echo $p1->__toString()."<br>";
echo $p2->__toString()."<br>";
// $d=strtotime("now");

// $bd = strtotime($p1->getAge());
// echo $p1->getFirstName()." ".$p1->getName()." a ".(date("Y", $d)-date("Y", $bd))." ans<br>";
// $bd = strtotime($p2->getAge());
// echo $p2->getFirstName()." ".$p2->getName()." a ".(date("Y", $d)-date("Y", $bd))." ans<br>";


?>
    
</body>
</html>