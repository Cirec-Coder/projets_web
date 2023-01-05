<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 9</h1>
    <p>Créer une fonction personnalisée permettant d’afficher des boutons radio avec un tableau de
        valeurs en paramètre ("Monsieur","Madame","Mademoiselle").
        <strong>Exemple :</strong><br>
        <code>afficherRadio($nomsRadio);</code>
    </p>
    <h2>Resultat :</h2>
    <?php
          // même principe que pour les CheckBox
          function genererCodeRadio(int $nbItems, string $nomGroup) {
            $ckb_BaseStr = "
            <div>
                <input type='radio' id='%s%d%%' name='$nomGroup'>
                <label for='%s%d%%'>%s%d%%</label>
            </div>
            ";
            $result = "";
            $i = 1;
            while ($i <= $nbItems) {
              $result = $result.str_replace("%d%", $i, $ckb_BaseStr);
              $i++;
            }
            return $result;
          }


          function genererRadio(array $elems, string $nomGroup) {
            $nbElem = count($elems);
            $ck_Boxs = genererCodeRadio($nbElem, $nomGroup); 
            for ($i=1; $i <= $nbElem ; $i++) { 
              $tagArray1[] = "%s$i%"; 
            }
            return str_replace($tagArray1, $elems, $ck_Boxs)."<br>";
          }
        
        // $elements = ["Homme", "Femme", "Animal", "Végétal", "Autre"];
        $elements = ["Monsieur","Madame","Mademoiselle", "Autre"];
        echo genererRadio($elements, "sex");
    
    ?>
</body>
</html>