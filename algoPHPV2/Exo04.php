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
<script type="text/javascript" src="editable.js"></script>
<body>
    <h1>Exercice 4</h1>
    <p>A partir de l’exercice 2, ajouter une colonne supplémentaire dans le tableau HTML<br> qui contiendra
        le lien hypertexte de la page Wikipédia de la capitale <br>(le lien hypertexte devra s’ouvrir dans un
        nouvel onglet et le tableau sera trié par ordre alphabétique de la capitale).<br>
        On admet que l’URL de la page Wikipédia de la capitale adopte la forme :
        <code>https://fr.wikipedia.org/wiki/</code><br>
        Le tableau passé en argument sera le suivant :<br>
        <code>$capitales = array ("France"=>"Paris","Allemagne"=>"Berlin",
            "USA"=>"Washington","Italie"=>"Rome","Espagne"=>"Madrid");</code>
    </p>
    <h2>Resultat 1 <span style="font-size: 0.7em;color: #444; font-style: oblique;">avec "array_change_key_case" & "array_keys"</span></h2>
    <?php
    // tableau clé => valeur
    //  clé := Pays
    // valeur := capitale
    $capitales = array("France" => "Paris", "Allemagne" => "Berlin", "USA" => "Washington", "Italie" => "Rome", "Espagne" => "Madrid");
    function afficherTableHTML($array)
    {   // defini la base du lien commune à tous les liens
        $baseLink = "https://fr.wikipedia.org/wiki/";
        // défini le tableau et son header
        $retValue = "<table>  <tr>  <th>Pays</th>  <th>Capitale</th>  <th>Lien wiki</th>  </tr>";
        // passe toutes les clés du tableau en majuscule
        $array = array_change_key_case($array, CASE_UPPER);
        // trie sur valeur
        asort($array);
        // parcours le tableau de clés renvoyé par "array_keys($array)"
        // $key contient le nom de la clé
        foreach (array_keys($array) as $key) {
            // si = à Washington
            if ($array[$key] == "Washington") {
                $addLink = "_(état)";   // alors on ajoute "_(état)"
            } else {
                $addLink = "";          // si non rien
            }
            // on construit le lien
            $link = "<a href=" . $baseLink . $array[$key] . $addLink . " target='_blank' rel='noopener noreferrer'>Lien</a>";
            // et on ajoute la ligne au tableau html
            $retValue = $retValue . "  <tr>  <td>" . $key . "</td>  <td>" . $array[$key] . "</td>   <td>" . $link . "</td>  </tr>";
        }
        // et on retourne le résultat en fermant la balise </table>
        return $retValue . "  </table>  ";
    }

    echo afficherTableHTML($capitales);

    // deuxième version simplifiée
    echo "<h2>Resultat 2 <span style='font-size: 0.7em;color: #444; font-style: oblique;'>plus simple</span></h2>";

    function afficherTableHTML2($array)
    {
        $baseLink = "https://fr.wikipedia.org/wiki/";
        $retValue = "<table>  <tr>  <th>Pays</th>  <th>Capitale</th>  <th>Lien wiki</th>  </tr>";
        $array = array_change_key_case($array, CASE_UPPER);
        asort($array);
        foreach ($array as $key => $name) {
            // utilisation d'une ternaire
            $addLink = ($name == "Washington") ? "_(état)" : "";

            $link = "<a href=" . $baseLink . $name . $addLink . " target='_blank' rel='noopener noreferrer'>Lien</a>";
            $retValue = $retValue . "  <tr>  <td>" . $key . "</td>  <td class='editable'>" . $name . "</td>   <td>" . $link . "</td>  </tr>";
        }
        return $retValue . "  </table>  ";
    }

    echo afficherTableHTML2($capitales);


    ?>
    <script type="text/javascript">EDITABLE.init();</script>
</body>

</html>