<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_exo.css">
    <title>Exercice N° 2</title>
</head>

<body>

    <h1 id="description">Exercice N° 2</h1>
    <p id="description"><strong><u>Vous êtes chargé(e) de créer un projet orienté objet permettant de gérer des livres et<br>
                leurs auteurs respectifs.<br></u></strong>
        Les livres sont caractérisés par un titre, un nombre de pages, une année de parution, un prix et un<br>
        auteur. Un auteur comporte un nom et un prénom.<br>
        Une méthode toString() sera appréciée dans chacune de vos classes.<br>
        Vous implémenterez une méthode <em>afficherBibliographie()</em> qui permettra d’afficher la bibliographie<br>
        complète d’un auteur :
    </p>
    <img id="description" src="../img/Img_Exo2.jpg" alt="Img_Exo2"><br>
    <h2 id="description">Resultat :</h2>


    <?php
    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include '../lib/class_' . $class_name . '.php';
    });

    $aut1 = new Auteur("Stephen", "King");
    $livreA = new Livre($aut1, "Ca", 1138, 1986, 20);
    $livreA = new Livre($aut1, "Simetierre", 374, 1983, 15);
    $livreA = new Livre($aut1, "Le Fléau", 823, 1978, 14);
    $livreA = new Livre($aut1, "Shining", 447, 1977, 16);

    echo $aut1->afficherBibliographie();
    // teste de modification d'un prix
    $aut1->getLivre("Ca")
         ->setPrix(40);
    // affichage du prix modifié
    echo $aut1->getLivre("Ca");

    // teste de modification d'un prix sur un livre inexistant 
    $aut1->getLivre("Californie")
         ->setPrix(40);
    echo $aut1->afficherBibliographie();

    $aut2 = new Auteur("Jules", "Vernes", [
        ["Voyage au centre de la Terre", 389, 1864, 6.95],
        ["De la Terre à la Lune", 475, 1865, 7.95],
        ["L'Île mystérieuse", 826, 1875, 8.95],
        ["20 Mille lieues sous les mers", 687, 1869, 12]
    ], true);
    echo $aut2->afficherBibliographie();

    ?>
</body>

</html>