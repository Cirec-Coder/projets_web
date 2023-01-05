<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 12</h1>
    <p>La fonction var_dump($variable) permet d’afficher les informations d’une variable.<br>
        Soit le tableau suivant :<br>
        <code>$tableauValeurs=array(true,"texte",10,25.369,array("valeur1","valeur2"));</code>
        A l’aide d’une boucle, afficher les informations des variables contenues dans le tableau.
</p>
<h2>Resultat :</h2>

<?php

    function showArrayVars(array $elements) {
        foreach ($elements as $element) {
            echo var_dump($element)."<br>";
        }
    }
    $tableauValeurs = array(true,"texte",10,25.369,array("valeur1","valeur2"));

    echo showArrayVars($tableauValeurs);
?>
</body>
</html>