<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<body>
    <h1>Exercice 8</h1>
    <p>Soit l’URL suivante : <code>http://my.mobirise.com/data/userpic/764.jpg</code><br>
    Créer une fonction personnalisée permettant d’afficher l’image N fois à l’écran.<br>
    <strong>Exemple :</strong><br>
    <code>repeterImage($url,4);<code></p>
    <h2>Resultat :</h2>

    <?php
        $url = "http://my.mobirise.com/data/userpic/764.jpg";

        function repeterImage(string $aUrl, int $nbImg) {
            for ($i=0; $i < $nbImg; $i++) { 
                echo "<img  src=".$aUrl." alt='userpic'>";
            }
            
        }
        echo repeterImage($url, 4);
    ?>
</body>
</html>