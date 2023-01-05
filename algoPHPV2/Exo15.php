<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exercices PHP-2 MMU V1.0</title>
    </head>
    <body>
        <h1>Exercice 15</h1>
        <p>En utilisant les ressources de la page http://php.net/manual/fr/book.filter.php, vérifier si une<br>
            adresse e-mail a le bon format.<br>
            Affichage<br>
            <code>L’adresse elan@elan-formation.fr est une adresse e-mail valide<br>
            L’adresse contact@elan est une adresse e-mail invalide</code><br></p>
            <h2>Resultat :</h2>

        <?php

            function validateEmail(string $email)
            {
                // méthode "standard"
                // if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //     echo "L'adresse ".$email." est une adresse e-mail valide<br>";
                // } else {
                //     echo "L'adresse ".$email." est une adresse e-mail invalide<br>";
                // }
                // On peut faire la même chose en une seule ligne grâce à une structure ternaire :
                echo "L'adresse ".$email." est une adresse e-mail ".(filter_var($email, FILTER_VALIDATE_EMAIL) ? "valide" : "invalide")."<br>";
            }

            validateEmail("elan@elan-formation.fr")."<br>"; 
            validateEmail("contact@elan")."<br>"; 
        ?>
    </body>
</html>