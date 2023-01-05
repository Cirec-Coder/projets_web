<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 03 (POO Cinema)</title>
</head>

<body>
    <h1>Résultat de l'exercice 03 (POO Cinema)</h1>
    <?php
    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include '../lib/class_' . $class_name . '.php';
    });

    $cinetheque = new Cinetheque();

    $real1 = new Realisateur($cinetheque, "Lucas", "Georges", "H", "1944-05-14");
    $film1 = new Film($real1, "La Guerre des étoiles", "SF", "1977", 244, "Un jour dans les étoiles, c'était la guerre");
    $cast1 = new Casting($film1);
    $act1 = new Acteur("Ford", "Harrison", "H", "1942-07-13");

    $film2 = new Film($real1, "L'Empire contre-attaque", "SF", "1980", 120, "L'empire décide de contre*attaquer");
    $cast2 = new Casting($film2);
    $act2 = new Acteur("Hamill", "Mark", "H", "1951-09-25");
    $role1 = new Role($film1, $cast1, $act1, "Han Solo");
    $role1 = new Role($film2, $cast2, $act1, "Han Solo");

    $role1 = new Role($film1, $cast1, $act2, "Luc Skywalker");
    $role1 = new Role($film2, $cast2, $act2, "Luc Skywalker");

    $film3 = new Film($real1, "Les Aventuriers de l'arche perdue", "SF", "1981", 120, "résumé");
    $cast3 = new Casting($film3);
    $role1 = new Role($film3, $cast3, $act1, "Indiana Jones");

    $real2 = new Realisateur($cinetheque, "Besson", "Luc", "H", "1959-03-18");
    $film4 = new Film($real2, "Le Cinquième Élément", "SF", "1997", 135, "résumé");
    $cast4 = new Casting($film4);
    $act3 = new Acteur("Willis", "Bruce", "H", "1955-03-19");
    $act4 = new Acteur("Jovovich", "Milla", "F", "1975-12-17");
    $act5 = new Acteur("Oldman", "Gary", "H", "1958-03-21");
    $role1 = new Role($film4, $cast4, $act3, "Korben Dallas");
    $role1 = new Role($film4, $cast4, $act4, "Leeloo");
    $role1 = new Role($film4, $cast4, $act5, "Jean-Baptiste Emanuel Zorg");

    // var_dump($film1);  Jean-Baptiste Emanuel Zorg
    // var_dump($act1);
    // echo $act1;
    // echo $real1->getNom();
    $cinetheque->listerFilms();
    $cinetheque->listerActeurs();
    $cinetheque->listerRealisateurs();
    $act1->filmographie();
    $act2->filmographie();
    // echo $film1;
    // echo $act1;
    // echo $act2;

    $dt = new DateTime("1980");
    echo $dt->format('Y')."<br>";
    echo date_time_set(new DateTime(), 0, 248)->format("H \h\\e\u\\r\\e(\s) \\e\\t i \m\\n")."<br>";
    ?>
    <form action="Exercice_03.php" method="post">
        <input type="submit" name="listerFilms" value="Lister tous les Films" />
        <input type="submit" name="listerActeurs" value="Lister tous les Acteurs" />
        <input type="submit" name="listerRealisateurs" value="Lister tous les Realisateurs" />

    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['listerFilms'])) {
            $cinetheque->listerFilms();
        } elseif (isset($_POST['listerActeurs'])) {
            $cinetheque->listerActeurs();
        } elseif (isset($_POST['listerRealisateurs'])) {
            $cinetheque->listerRealisateurs();
        }

        ?>
            <br><br>
            <input type="button" name="goBack" value=" <== Retour " onclick="javascript:history.back()"/>
        <?php
    }
    ?>
</body>

</html>