<!-- 
    Ce fichier sert uniquement à créer les objets et les remplir 
    afin de pouvoir tester le code
 -->
<?php

    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include 'class/'.$class_name . '.php';
    });


$real1 = new Realisateur("Georges", "Lucas", "H", "1944-05-14");
$genreSF = new Genre(Genre::GENRE_SF);
$film1 = new Film($real1, "La Guerre des étoiles", $genreSF, "1977-10-19", 244, "Il y a bien longtemps, dans une galaxie très lointaine... La guerre civile fait rage entre l'Empire galactique et l'Alliance rebelle."); 
$act1 = new Acteur("Harrison", "Ford", "H", "1942-07-13");
$role1 = new Role("Han Solo"); 
$casting1 = new Casting($film1, $role1, $act1);

$act2 = new Acteur("Mark", "Hamill", "H", "1951-09-25");
$role2 = new Role("Luc Skywalker");
$casting2 = new Casting($film1, $role2, $act2);

$film2 = new Film($real1, "L'Empire contre-attaque", $genreSF, "1980-08-20", 120, "L'empire décide de contre-attaquer");
$casting3 = new Casting($film2, $role1, $act1);
$casting4 = new Casting($film2, $role2, $act2);

$film3 = new Film($real1, "Les Aventuriers de l'arche perdue", $genreSF, "1981", 120, "résumé");
$role3 = new Role("Indiana Jones");
$casting5 = new Casting($film3, $role3, $act1);


$real2 = new Realisateur("Andrew", "Davis", "H", "1946-11-21");
$genreThriller = new Genre(Genre::GENRE_THRILLER);
$film4 = new Film($real2, "Le fugitif", $genreThriller, "1993-09-01", 130, "résumé");
$role4 = new Role("Dr Richard Kimble");
$casting5 = new Casting($film4, $role4, $act1);


$real3 = new Realisateur("Luc", "Besson", "H", "1959-03-18");
$film5 = new Film($real3, "Le Cinquième Élément", $genreSF, "1997-05-07", 135, "résumé");
$act3 = new Acteur("Bruce", "Willis", "H", "1955-03-19");
$act4 = new Acteur("Milla", "Jovovich", "F", "1975-12-17");
$act5 = new Acteur("Gary", "Oldman", "H", "1958-03-21");
$role5 = new Role("Korben Dallas");
$casting6 = new Casting($film5, $role5, $act3);
$role6 = new Role("Leeloo");
$casting7 = new Casting($film5, $role6, $act4);
$role7 = new Role("Jean-Baptiste Emanuel Zorg");
$casting8 = new Casting($film5, $role7, $act5);

$real4 = new Realisateur("Tim", "Burton", "H", "1958-08-25");
$genreAction = new Genre(Genre::GENRE_ACTION);
$film6 = new Film($real4, "Batman", $genreAction, "1989-09-13", 125, "résumé");
$act6 = new Acteur("Michael", "Keaton", "H", "1957-09-05");
$role8 = new Role("Batman");
$casting9 = new Casting($film6, $role8, $act6);

$act7 = new Acteur("Jack", "Nicholson", "H", "1937-04-22");
$role9 = new Role("Le Joker");
$casting10 = new Casting($film6, $role9, $act7);

//*************************************************************************


$real5 = new Realisateur("Matt", "Reeves", "H", "1966-04-27");
$film7 = new Film($real5, "The Batman", $genreAction, "2022-03-02", 177, "résumé");
$act8 = new Acteur("Robert", "Pattinson", "H", "1986-05-13");
$casting11 = new Casting($film7, $role8, $act8);



$real6 = new Realisateur("Christopher", "Nolan", "H", "1970-07-30");
$film8 = new Film($real6, "The Dark Knight", $genreAction, "2008-08-13", 152, "résumé");
$act9 = new Acteur("Christian", "Bale", "H", "1974-01-30");
$casting12 = new Casting($film8, $role8, $act9);

// ces tableaux servent à accéder aux données lors des différents testes
$reals = [$real1, $real2, $real3, $real4, $real5, $real6];
$films = [$film1, $film2, $film3, $film4, $film5, $film6, $film7, $film8];
$acteurs = [$act1, $act2, $act3, $act4, $act5, $act6, $act7, $act8, $act9];
$roles = [$role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8, $role9];

