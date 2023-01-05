<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>

<body>
    <h1>Exercice 11</h1>
    <p>Ecrire une fonction personnalisée qui affiche une date en français (en toutes lettres) à partir d’une<br>
        chaîne de caractère représentant une date.<br>
        <strong>Exemple :</strong><br>
        <code>formaterDateFr("2018-02-23");</code>
    </p>

    <h2>Resultat 1 :</h2>
    <?php

    function formaterDateFr($aDate = null)
    {
        if ($aDate == "") {
            $aDate = "now";
        }
        $IntlCalendar = IntlCalendar::fromDateTime($aDate, " Europe/Paris");
        $jour = ucfirst(IntlDateFormatter::formatObject($IntlCalendar, "eeee", 'fr-FR'));
        $mois = ucfirst(IntlDateFormatter::formatObject($IntlCalendar, "MMMM", 'fr-FR'));;

        return IntlDateFormatter::formatObject($IntlCalendar, "'$jour' d '$mois' Y", 'fr-FR');
    }

    echo "Nous étions le : " . formaterDateFr("2018-02-23") . "<br>";
    echo "Aujourd'hui nous sommes le : " . formaterDateFr() . "<br>";


    echo "<h2>Resultat 2 :</h2>";

    // Deuxièmme version utilisant un DateTime
    // et un tableau pour construire le résultat
    function formaterDateFr2($aDateTime)
    {
        $dt = new DateTime($aDateTime);
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
        $formatter->setPattern('eeee d MMMM yyyy');
        $strDate = $formatter->format($dt);

        $explodedDate = explode(" ", $strDate);
        echo "Nous sommes le " . ucfirst($explodedDate[0]) . " " . 
            $explodedDate[1] . " " . 
            ucfirst($explodedDate[2]) . " " . 
            $explodedDate[3] . "<br>";
    }

    formaterDateFr2("2018-02-23");
    formaterDateFr2("now");
    ?>
</body>

</html>