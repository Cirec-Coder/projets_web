<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 6</h1>
    <p>Créer une fonction personnalisée permettant de remplir une liste déroulante <br>
        à partir d'un tableau de valeurs. <br>
        <strong>Exemple :</strong><br>
        <code>$elements = array("Monsieur","Madame","Mademoiselle");
        alimenterListeDeroulante($elements);</code>
    </p>
    <h2>Resultat :</h2>
<?php
    function alimenterListeDeroulante(array $items) {
            $result = "<select id='monselect'>";
            foreach($items as $item) {
                if ($item == "Monsieur") {
                    $add = " selected";
                } else {
                    $add = "";
                }

                $result = $result."<option value='.$item.$add.'>".$item."</option>";
            }
            return $result."</select>";
    }

    $elements = array("Monsieur","Madame","Mademoiselle");

    echo alimenterListeDeroulante($elements);
?>
</body>
</html>