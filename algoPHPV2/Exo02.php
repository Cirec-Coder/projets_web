<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP-2 MMU V1.0</title>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid #808080;
        border-collapse: collapse;
        text-align: left;
        padding: 0.3em 0.3em 0.3em 0.3em;
    }

</style>
<body>
    <h1>Exercice 2</h1>
    <p>Soit le tableau suivant :
        <code> $capitales = array
            ("France"=>"Paris","Allemagne"=>"Berlin","USA"=>"Washington","Italie"=>"Rome");
        </code> <br>
        Réaliser un algorithme permettant d’afficher le tableau HTML suivant (notez que le nom du pays
        s’affichera en majuscule et que le tableau est trié par ordre alphabétique <strong>du nom de pays</strong>) grâce à
        une fonction personnalisée. <br>
        Vous devrez appeler la fonction comme suit : <code>afficherTableHTML($capitales);</code> 
    </p>
    <h2>Resultat 1 <span style="font-size: 0.7em;color: #444; font-style: oblique;">avec "array_change_key_case" & "array_keys"</span></h2>
<?php
    // tableau clé => valeur
    $capitales = array("France"=>"Paris","Allemagne"=>"Berlin","USA"=>"Washington","Italie"=>"Rome");

    function afficherTableHTML(array $array) {
        // défini le tableau et son header
        $retValue = "<table><tr><th>Pays</th><th>Capitale</th></tr>";
        // passe toutes les clés du tableau en majuscule
        $array = array_change_key_case($array, CASE_UPPER);
        // trie sur clés
        ksort($array);
        foreach(array_keys($array) as $name) {
            // ajout des données au tableau
            $retValue = $retValue."<tr><td>".$name."</td><td>".$array[$name]."</td></tr>";
        }
        return $retValue."</table>"; // fermeture du tableau et renvoi du résultat
    }

    echo afficherTableHTML($capitales);

    echo "<h2>Resultat 2 <span style='font-size: 0.7em;color: #444; font-style: oblique;'>plus simple</span></h2>";

    $capitales = array("France"=>"Paris","Allemagne"=>"Berlin","USA"=>"Washington","Italie"=>"Rome");

    function afficherTableHTML2(array $array) {
        $retValue = "<table><tr><th>Pays</th><th>Capitale</th></tr>";
        ksort($array);
        // pour chaque élément du tableau on récupère la clé($pays) et la valeur($ville)
        foreach($array as $pays => $ville) {
            $retValue = $retValue."<tr><td>".strtoupper($pays)."</td><td>".$ville."</td></tr>";
        }
        return $retValue."</table>";
    }

    echo afficherTableHTML2($capitales);
?>
</body>
</html>