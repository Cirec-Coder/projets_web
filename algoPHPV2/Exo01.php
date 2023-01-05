<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 1</h1>
    <p>
    Créer une fonction personnalisée <em>convertirMajRouge()</em><br> permettant de transformer une chaîne de
    caractère passée en argument en majuscules et en rouge. <br>
    Vous devrez appeler la fonction comme suit : <em> convertirMajRouge($texte) ;</em>
    </p>
    <div style='border: 1px solid #444; width: 40%;'>
        <code>Affichage (si $texte = « Mon texte en paramètre »)<br>
        <span style='color: red;'>MON TEXTE EN PARAMETRE</span></code>
    </div>
    <h2>Resultat :</h2>
    <?php
        // fonction convertirMajRouge 
        //      $txt: le texte à convertir en majuscule et en rouge  
        function convertirMajRouge($txt) {
            return "<span style='color: red;'>".
                    //  mb_strtoupper converti la chaine en majuscule en conservant les accents
                    mb_strtoupper($txt)."</span>";
            //cette version remplace les caractères accentués.
            // strtoupper(transliterator_transliterate('Latin-ASCII',$txt))."</span>";
        }
        $phrase = "Mon texte en paramètre";

        echo convertirMajRouge($phrase);
    ?>
</body>
</html>