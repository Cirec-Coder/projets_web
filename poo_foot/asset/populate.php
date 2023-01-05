<?php
// permet le chargement automatique des Classes utiles au code
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});

$country1 = new Country("France");

$club1 = new Club($country1, "PSG", "Paris", "");
$club2 = new Club($country1, "OM", "Marseille", "");
$club3 = new Club($country1, "OL", "Lyon", "");
$player1 = new Player($club1, "Jr", "NEYMAR", "1992-02-05", "Brésilienne");
$player2 = new Player($club1, "Lionel", "Messi", "1987-06-24", "Argentine");
$player3 = new Player($club1, "Kylian", "Mbappé", "1998-12-20", "Française");

$player1->addClub("PSG", "2017");
$player1->addClub("Barça", "2013");
$player1->addClub("Seleção", "2009");
$player1->addClub("FC Santos", "2008");

$player2->addClub("FC Barcelone", "2004");
$player2->addClub("PSG", "2021");
$player3->addClub("AS Monaco", "2015 à 2017");


$country2 = new Country("Allemagne");
$club4 = new Club($country2, "Bayern Munich", "Munich", "");
$club5 = new Club($country2, "Borussia Dortmund", "Dortmund", "");
$player4 = new Player($club4, "Marco", "Reus", "1989-05-31", "Allemande");
$player5 = new Player($club4, "Karim", "Adeyemi", "2002-01-18", "Nigériane");

$countries = [$country1, $country2];


function buildMenuCountry()
{
    $ret = "";
    global $countries;
    foreach ($countries as $key => $country) {
        $name = $country->getName();
        $ret .= "<a href='traitement.php?country=$name'>$name</a>";
    }
    echo $ret;
}

function buildMenuClub()
{
    $ret = "";
    global $countries;
    foreach ($countries as $key => $country) {
        if ($country->getName() == $_SESSION['countryName']) {
            foreach ($country->getClubs() as $key => $club) {
                $name = $club->getName();
                $ret .= "<a href='traitement.php?club=$name'>$name</a>";
            }
        }
    }
    echo $ret;
}

function buildMenuPlayer()
{
    $ret = "";
    global $countries;
    foreach ($countries as $key => $country) {
        if ($country->getName() == $_SESSION['countryName']) {
            if (isset($_SESSION['clubName']) and ($_SESSION['clubName'] == "")) {
                    $clubs = $country->getClubs();
                if (count($clubs) > 0) {
                    $_SESSION['clubName'] = $clubs[0]->getName();
                    foreach ($clubs[0]->getPlayers() as $key => $value) {
                        $firstName = $value->getFirstName();
                        $name = $value->getName();
                        $ret .= "<a href='traitement.php?player=$name'>$firstName $name</a>";
                    }
                }
            } else {
                foreach ($country->getClubs() as $key => $club) {
                    if (isset($_SESSION['clubName']) and $club->getName() == $_SESSION['clubName']) {
                        foreach ($club->getPlayers() as $key => $value) {
                            $firstName = $value->getFirstName();
                            $name = $value->getName();
                            $ret .= "<a href='traitement.php?player=$name'>$firstName $name</a>";
                        }
                    }
                }
            }
        }
    }
    echo $ret;
}

