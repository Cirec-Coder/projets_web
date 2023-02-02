<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 5</h1>
    <p>Créer une fonction personnalisée permettant de créer un formulaire de champs de texte en
        précisant le nom des champs associés. <br>
        <strong>Exemple :</strong><br>
        <code>$nomsInput = array("Nom","Prénom","Ville");<br>
        afficherInput($nomsInput);</code>
</p>
<h2>Resultat :</h2>
<?php
    function afficherInput(array $names) {
        $result = "";
        foreach($names as $name) {
            $result = $result."<label for=l".$name.">".$name."</label><br><input type='text' id=l".$name." name=l".$name."><br>";
        }
        return $result;
    }

    $nomsInput = array("Nom","Prénom","Ville");

    echo afficherInput($nomsInput);
    // affiche le contenu de la variable contenant des balises html
    // var_dump(htmlentities(afficherInput($nomsInput)));

?>
</body>
</html>