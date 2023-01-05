<?php
// require_once("lib/dbconnect.php"); //le fichier de connexion à la BDD
require_once("dbFunctions.php"); //le fichier de connexion à la BDD
require_once("Debug.php"); //pour afficher les données 


// $filmsStatement = $db->prepare('SELECT * FROM films');

function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = json_encode($data);
    $data = addslashes($data);
    return $data;
}

$filmData = [];
// récupère les données du film sur AlloCiné
function getFilmDatas($searchString)
{
    $Months = array("/janvier/", "/février/", "/mars/", "/avril/", "/mai/", "/juin/", "/juillet/", "/août/", "/septembre/", "/octobre/", "/novembre/", "/décembre/");
    $NumMonths = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
    $result = [];
    // $searchString = preg_replace("/ /", "_", $searchString);
    $content = file_get_contents("https://www.allocine.fr/rechercher/?q=$searchString");
    // file_put_contents('./output2.txt', $content);

    if (preg_match('#<span class="(?:.*)meta-title-link">(.*?)</span>#', $content, $match)) {
        // Debug::debug($match);
        $title = $match[1];
        $result['title'] = $title;
    }
    // 
    if (preg_match('#<span class="(?:.*)blue-link">(.*?)</span>#', $content, $match, PREG_OFFSET_CAPTURE)) {
        // Debug::debug($match);
        $real = $match[1][0];
        $result['realisateur'] = $real;
    }

    if (preg_match('#<span class="date">(.*?)</span>#', $content, $match, PREG_OFFSET_CAPTURE)) {
        $date = $match[1][0];
        $result['date'] = preg_replace($Months, $NumMonths, $date);
    }
    // Debug::debug($match);
    // récupère les 2 premiers Acteurs ayant participés au Film
    for ($i = 1; $i < 3; $i++) {
        if (preg_match('#<span class="(?:.*)">(.*?)</span>,#', $content, $match, PREG_OFFSET_CAPTURE, $match[1][1])) {
            // Debug::debug($match);
            $real = $match[1][0];
            $result["acteur$i"] = $real;
        }
    }
    // Debug::debug($result);

    // récupère le 3ème Acteur ayant participé au Film
    if (preg_match('#<span class="(?:.*)">(.*?)</span>#', $content, $match, PREG_OFFSET_CAPTURE, $match[1][1])) {
        $real = $match[1][0];
        $result["acteur$i"] = $real;
    }

    // récupère le Synopsis du Film
    if (preg_match('#class="content-txt ">(?s)(.*?)</div>#', $content, $match, PREG_OFFSET_CAPTURE, $match[1][1])) {
        
        $real = $match[1][0];
        $result["synopsis"] = htmlspecialchars($real);
    }

    // echo test_input($real);
    //   Debug::debug($result);


    // récupère le Synopsis du Film
    // $p = strpos($content, '<div class="content-txt ">') + strlen('<div class="content-txt ">');
    // if ($p < 500) {
    //     $result['synopsis'] = "";
    // } else {
    //         // Debug::debug($p);
    //     $pe = strpos($content, '</div>', $p);
    //     $synopsis = substr($content, $p, $pe - $p);
    //     $result['synopsis'] = $synopsis;
    // }

    return $result;
}

function print_var_name($var) {
    foreach($GLOBALS as $var_name => $value) {
        if ($value === $var) {
            return $var_name;
        }
    }

    return false;
}

// recherche les informations du réalisateur & des Acteurs sur Wikipedia
function getActOrRealDatas($searchString, $name = "acteur")
{
    $result = [];
    $searchString = ucwords($searchString);
    $splitedString = preg_split("/(\s)/", $searchString);
    $result['prenom'] = $splitedString[0];
    $result['nom'] = $splitedString[1];
    $searchString = preg_replace("/ /", "_", $searchString);

    $content = file_get_contents("https://fr.wikipedia.org/wiki/$searchString");
    // file_put_contents('./output.txt', $content);
    if (preg_match('#<time class="nowrap date-lien bday" datetime="(.*?)" data-sort-value#', $content, $match, PREG_OFFSET_CAPTURE)) {
        $date = $match[1]; 
        $result['date'] = $date[0];
        $result['offset'] = $date[1];;
    } else {
        // si un homonyme existe on affine la recherche
        if (strpos($content, "$searchString"."_($name)") > 0)
        {
            $content = file_get_contents("https://fr.wikipedia.org/wiki/$searchString"."_($name)");
            if (preg_match('#<time class="nowrap date-lien bday" datetime="(.*?)" data-sort-value#', $content, $match, PREG_OFFSET_CAPTURE)) {
                $date = $match[1]; 
                $result['date'] = $date[0];
                $result['offset'] = $date[1];;
            }
            
        }
    }
    // Debug::debug($result);
    return $result;
}

if (isset($_GET)) {
    // debug::debug($_GET);
    switch ($_GET['action']) {
        case 'search':
            if (isset($_GET['q'])) {

                $films = [];
                $films = getFilmDatas($_GET['q']);

                $filmData['film'] = $films;
                $filmData['realisateur'] = getActOrRealDatas($films['realisateur'],'realisateur');
                $filmData['acteur1'] = getActOrRealDatas($films['acteur1']);
                $filmData['acteur2'] = getActOrRealDatas($films['acteur2']);
                $filmData['acteur3'] = getActOrRealDatas($films['acteur3']);
                $dbResult = getFilmIfExists($filmData['film']['title'], $filmData['realisateur']['nom']);
                // if (isset($dbResult) and count($dbResult)>0) {
                if ($dbResult) {
                    debug::debug($dbResult);
                    miseaJourSynopsis($dbResult[0]['id_film'], $filmData['film']['title'], $filmData['film']['synopsis']); 
                } else {
                    addFilm($filmData);
                }
                foreach ($films as $key => $value) {
                    if ($key == "date") {
                        // $d = new DateTime($value, new DateTimeZone("Europe/Paris"));
                        // $d = new DateTime();
                        // debug::debug($value);
                        $d = DateTime::createFromFormat("d m Y", $value, new DateTimeZone("Europe/Paris"));

                        // $d1 = $d->createFromFormat('d F Y', $value, new DateTimeZone("Europe/Paris"));
                        // $d = new DateTime(substr($value, strlen($value)-4,4));
                        // echo $d1->diff(new DateTime('1900'))->y;
                        // debug::debug($d->format('Y'));
                        echo "<b>$key</b> = " . $d->format('Y') . "<br>";
                        // echo "<b>$key</b> = ".substr($value, strlen($value)-4,4)."<br>";
                    } else {
                        echo "<b>$key</b> = $value <br>";
                    }
                }
                // substr($films['date'], strlen($films['date'])-4, 4)

                // echo "<code><pre>". $films['date'] ."</pre></code>";
                //     $d = new DateTime($films['date']);
                //   echo  date('Y', $d->getTimestamp());

            Debug::debug($filmData);
            }
            break;
    }
}
