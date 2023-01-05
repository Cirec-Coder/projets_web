<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 7</h1>
    <p>Créer une fonction personnalisée permettant de générer des cases à cocher.<br> On pourra préciser
        dans le tableau associatif si la case est cochée ou non.<br>
        <strong>Exemple :</strong><br>
        <code>genererCheckbox($elements);
        //où $elements est un tableau associatif clé => valeur avec 3 entrées.</code>
    </p>
    <h2>Resultat :</h2>

    <?php

          function genererCodeCheckBox(int $nbItems) {
            $ckb_BaseStr = "
            <div>
              <input type='checkbox' id='%s%d%%' name='%s%d%%' %b%d%%>
              <label for='%s%d%%'>%s%d%%</label>
            </div>";
            $result = "";
            $i = 1;
            while ($i <= $nbItems) {
              // construit les CheckBox en les rendants unique 
              $result = $result.str_replace("%d%", $i, $ckb_BaseStr);
              $i++;
            }
            return $result;
          }

          function genererCheckbox(array $elems) {
            $nbElem = count($elems);
            // on genère le code de base
            $ck_Boxs = genererCodeCheckBox($nbElem); 
            for ($i=1; $i <= $nbElem ; $i++) { 
              // remplis les tableaux de remplacement
              $tagArray1[] = "%s$i%"; 
              $tagArray2[] = "%b$i%"; 
            }
            // termine la construction du code et le renvoi
            $ck_Boxs = str_replace($tagArray1, array_keys($elems), $ck_Boxs);
            return str_replace($tagArray2, $elems, $ck_Boxs)."<br>";
          }
        
        $elements = ["HTML 5" => "", "JavaScript" => "checked", "PHP" => "", "Pascal Objet" => "checked"];
        echo genererCheckbox($elements);

    ?>


</body>
</html>