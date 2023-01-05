<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>

<body>
    <h1>Exercice 10</h1>
    <p>En utilisant l’ensemble des fonctions personnalisées crées précédemment, créer un formulaire<br>
        complet qui contient les informations suivantes : champs de texte avec nom, prénom, adresse email, ville, sexe et une liste de choix parmi lesquels on pourra sélectionner un intitulé de formation :<br>
        « Développeur Logiciel », « Designer web », « Intégrateur » ou « Chef de projet ».<br>
        Le formulaire devra également comporter un bouton permettant de le soumettre à un traitement<br>
        de validation (submit).<br>
    </p>
    <h2>Resultat :</h2>

    <?php

    function afficherInput(array $names)
    {
        $result = ""; //<div style='width: 15%; background-color: #81818130; padding: 1em'>";
        foreach ($names as $name) {
            $result = $result . "<label for=l" . $name . ">" . $name . "</label><br><input type='text' id=l" . $name . " name=l" . $name . " style='width: 95%'><br>";
        }
        return $result; //."</div>";
    }

    function genererCodeRadio(int $nbItems, string $nomGroup)
    {
        $ckb_BaseStr = "
            <div>
                <input type='radio' id='%s%d%%' name='$nomGroup'>
                <label for='%s%d%%'>%s%d%%</label>
            </div>
            ";
        $result = "";
        $i = 1;
        while ($i <= $nbItems) {
            $result = $result . str_replace("%d%", $i, $ckb_BaseStr);
            $i++;
        }
        return $result;
    }


    function genererRadio(array $elems, string $nomGroup)
    {
        $nbElem = count($elems);
        $ck_Boxs = genererCodeRadio($nbElem, $nomGroup);
        for ($i = 1; $i <= $nbElem; $i++) {
            $tagArray1[] = "%s$i%";
        }
        return str_replace($tagArray1, $elems, $ck_Boxs) . "<br>";
    }

    $nomsInput = array("Nom", "Prénom", "Email", "Ville");
    $elementGenre = ["Homme", "Femme", "Autre"];

    $formulaire = "<form style='
                            display: flex; 
                            padding: 1em; 
                            border: 1px solid #444; 
                            width: 50%;
                            resize: horizontal;
                            overflow: auto; 
                            min-width: 35%; 
                            max-width: 75%;
                            '><div style='width: 75%'>" . 
                            afficherInput($nomsInput) . 
                            "</div><div style='
                                display: flex; 
                                flex-flow: column; 
                                justify-content: center; 
                                padding: 1em 0 0 1em; 
                                width: 25%;'>" . 
                            genererRadio($elementGenre, "genre") . 
                            "<input type='submit' value='Valider'></div>
                    </form>";
    echo $formulaire;
    ?>
</body>

</html>