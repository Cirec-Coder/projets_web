<?php
    // permet le chargement automatique des Classes utiles au code
    spl_autoload_register(function ($class_name) {
        include 'class/'.$class_name . '.php';
    });


    include 'asset/populate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Affichage</title>
</head>
<body>
<?php include_once "view/header.php" ?>
    <main>
    <div class="title-container">
    <?php
        if (isset($_POST['action'])){

            switch($_POST['action']){
                // on exécute le code qui correspond à la valeur de 'action'
                // Affiche la filmographie d'un Réalisateur
                case "showFilmRealisateur":
                    if (isset($_POST['selectReal'])) {
                        // récupère le nom du réalisateur sélectionné
                        $name = $_POST['selectReal']; 
                        $table = "<table>
                        <thead>
                        <tr>
                            <th scope='col' width=300>TITRE</th>
                            <th scope='col' width=80>SORTIE</th>
                            <th scope='col' width=80>DURÉE</th>
                            <th scope='col' width=200>GENRE</th>
                        </tr>
                        </thead>
                        ";
                        // on cherche dans le tableau de realisateur "$reals"
                        foreach ($reals as $key => $value) {
                            // celui qui correspond à la sélection
                            if ($name == $value->getPrenom() . $value->getNom()) {
                                // si trouvé on affiche son Prénom et son Nom
                                $table .= "<caption> <h2>Films réalisé par :</h2>
                                <h3 id='info-Table'>" . $value->getPrenom(). " " . $value->getNom() . "
                                ";
                                    // popup pour les infos du réalisateur
                                    $table .= "<div class='popup' id='popup-realisateur'>
                                    <h3>Réalisateur :</h3>
                                    <p>
                                      <strong>Prénom : </strong>".$value->getPrenom()."<br>
                                      <strong>Nom : </strong>".$value->getNom()."<br>
                                      <strong>Né le : </strong>".$value->getBirthDay()."<br>
                                      <strong>Age : </strong>".$value->getAge()."<br>
                                    </p>
                                </div>
                                </h3></caption>
                                <tbody>";
                                    
                                    foreach ($value->getFilms() as $film) {
                                        // et pour chaque film réalisé 
                                        // on affiche les informations
                                        $table .= "<tr>
                                        <td scope='row'>" . $film->getTitle() . "</td>
                                        <td scope='row' align='center'>" . $film->getAnneeDeSortie() . "</td>
                                        <td scope='row' align='center' title='".$film->getDureeHrsMn()."'>" . $film->getDuree() . "</td>
                                        <td scope='row' align='center'>" . $film->getGenre() . "</td>
                                        </tr>";
                                    }
                                break;
                            }
                        }
                        echo $table .= "</tbody></table>";
                    }
                break;

                // Affiche la filmographie d'un Acteur
                case "showFilmActeur":
                    if (isset($_POST['selectActor'])) {
                        // récupère l'acteur sélectionné
                        $name = $_POST['selectActor']; 
                        $table = "<table>
                        <thead>
                        <tr>
                            <th scope='col' width=300>TITRE</th>
                            <th scope='col' width=80>SORTIE</th>
                            <th scope='col' width=80>DURÉE</th>
                            <th scope='col' width=200>RÉALISATEUR</th>
                        </tr>
                        </thead>
                        ";
                        // pour chaque acteur dans le tableau $acteurs
                        foreach ($acteurs as $key => $acteur) {
                            // si l'acteur correspond
                            if ($acteur->getPrenom().$acteur->getNom() == $name) {
                                $table .= "<caption> <h2>Filmographie de :</h2>
                                <h3 id='info-Table'>" . $acteur->getPrenom() . " " . $acteur->getNom() . "
                                ";
                                // popup pour les infos de l'acteur
                                $table .= "<div class='popup'  id='popup-acteur'>
                                <h3>Acteur :</h3>
                                    <p>
                                      <strong>Prénom : </strong>".$acteur->getPrenom()."<br>
                                      <strong>Nom : </strong>".$acteur->getNom()."<br>
                                      <strong>Né le : </strong>".$acteur->getBirthDay()."<br>
                                      <strong>Age : </strong>".$acteur->getAge()."<br>
                                    </p>
                                </div>
                                </h3></caption>
                                <tbody>";
                                foreach ($acteur->getFilms() as $key => $film) {
                                    // on affiche les données
                                    $table .= "<tr>
                                    <td scope='row' id='info-td-film'>" . $film->getTitle() . "
                                    ";
                                    // popup pour les infos du film
                                    $table .= "<div class='popup'>
                                    <h3>Film :</h3>
                                    <p>
                                      <strong>Titre : </strong>".$film->getTitle()."<br>
                                      <strong>Date de sortie : </strong>".$film->getStrDateSortie()."<br>
                                      <strong>Durée : </strong>".$film->getDureeHrsMn()."<br>
                                      <strong>Genre : </strong>".$film->getGenre()."<br>
                                    </p>
                                </div>
                        </td>
                                    <td scope='row' align='center'>" . $film->getAnneeDeSortie() . "</td>
                                    <td scope='row' align='center' title='".$film->getDureeHrsMn()."'>" . $film->getDuree() . "</td>
                                    <td scope='row' align='center' id='info-td-realisateur'>" . $film->getRealisateur()->getPrenom() . " " . $film->getRealisateur()->getNom() . "
                                    ";
                                    // popup pour les infos du réalisateur
                                    $table .= "                                    <div class='popup'>
                                    <h3>Réalisateur :</h3>
                                    <p>
                                      <strong>Prénom : </strong>".$film->getRealisateur()->getPrenom()."<br>
                                      <strong>Nom : </strong>".$film->getRealisateur()->getNom()."<br>
                                      <strong>Né le : </strong>".$film->getRealisateur()->getBirthDay()."<br>
                                      <strong>Age : </strong>".$film->getRealisateur()->getAge()."<br>
                                    </p>
                                </div>
                                    </td>
                                    </tr>";
                                }
                            }
                        }
                        echo $table .= "</tbody></table>";
                    }
                break; // case "showFilmActeur"

                // Affiche les Acteurs ayant intepreté le Role
                case "showActeurRole":
                    if (isset($_POST['selectRole'])) {
                        // récupère le role sélectionné
                        $name = $_POST['selectRole']; 
                        $table = "<table>
                        <thead>
                        <tr>
                            <th scope='col' width=300>ACTEUR</th>
                            <th scope='col' width=300>TITRE</th>
                            <th scope='col' width=80>SORTIE</th>
                            <th scope='col' width=80>DURÉE</th>
                            <th scope='col' width=200>RÉALISATEUR</th>
                        </tr>
                        </thead>
                        <caption> <h2>Liste des Acteurs ayant intepreté le Rôle de :</h2>
                        <h3 id='info-Table'>$name</h3></caption>
                        <tbody>";
                        // pour chaque role dans le tableau $roles
                        foreach ($roles as $key => $role) {
                            // si le role correspond
                            if ($role->getRoleName() == $name) {
                                foreach ($role->getCasting() as $key => $casting) {
                                    // on affiche les données
                                    $table .= "<tr>
                                    <td scope='row' id='info-td-acteur'>" . $casting->getActeur() . "
                                    ";
                                    // popup pour les infos de l'acteur
                                    $table .= "<div class='popup'>
                                    <h3>Acteur :</h3>
                                    <p>
                                      <strong>Prénom : </strong>".$casting->getActeur()->getPrenom()."<br>
                                      <strong>Nom : </strong>".$casting->getActeur()->getNom()."<br>
                                      <strong>Né le : </strong>".$casting->getActeur()->getBirthDay()."<br>
                                      <strong>Age : </strong>".$casting->getActeur()->getAge()."<br>
                                    </p>
                                    </div>
                                    </td>
                                    <td scope='row'>" . $casting->getFilm()->getTitle() . "</td>
                                    <td scope='row' align='center'>" . $casting->getFilm()->getAnneeDeSortie() . "</td>
                                    <td scope='row' align='center' title='".$casting->getFilm()->getDureeHrsMn()."'>" . $casting->getFilm()->getDuree() . "</td>
                                    <td scope='row' align='center' id='info-td-film'>" . $casting->getFilm()->getRealisateur()->getPrenom() . " " . $casting->getFilm()->getRealisateur()->getNom() . "
                                    ";
                                    // popup pour les infos du réalisateur
                                    $table .= "                                    <div class='popup'>
                                    <h3>Réalisateur :</h3>
                                    <p>
                                      <strong>Prénom : </strong>".$casting->getFilm()->getRealisateur()->getPrenom()."<br>
                                      <strong>Nom : </strong>".$casting->getFilm()->getRealisateur()->getNom()."<br>
                                      <strong>Né le : </strong>".$casting->getFilm()->getRealisateur()->getBirthDay()."<br>
                                      <strong>Age : </strong>".$casting->getFilm()->getRealisateur()->getAge()."<br>
                                    </p>
                                    </div>
                                    </td>
                                    </tr>";
                                }
                            }
                        }
                        echo $table .= "</tbody></table>";
                    }
                break; // case "showActeurRole"

                // Affiche les Films par Genre
                case "showByGender":
                    if (isset($_POST['selectGender'])) {
                        // récupère le genre de film sélectionné
                        $name = $_POST['selectGender']; 
                        $table = "<table>
                        <thead>
                        <tr>
                            <th scope='col' width=300>TITRE</th>
                            <th scope='col' width=80>SORTIE</th>
                            <th scope='col' width=80>DURÉE</th>
                            <th scope='col' width=200>RÉALISATEUR</th>
                        </tr>
                        </thead>
                        <caption> <h2>List des Films de Genre :</h2>
                        <h3 id='info-Table'>$name</h3></caption>
                        <tbody>";
                        // pour chaque film dans le tableau $films
                        foreach ($films as $key => $film) {
                            // si le genre correspond
                            if ($film->getGenre() == $name) {
                                // on affiche les données
                                $table .= "<tr>
                                <td scope='row'>" . $film->getTitle() . "</td>
                                <td scope='row' align='center'>" . $film->getAnneeDeSortie() . "</td>
                                <td scope='row' align='center' title='".$film->getDureeHrsMn()."'>" . $film->getDuree() . "</td>
                                <td scope='row' align='center' id='info-td-realisateur'>" . $film->getRealisateur()->getPrenom() . " " . $film->getRealisateur()->getNom() . "
                                ";
                                // popup pour les infos du réalisateur
                                $table .= "<div class='popup' id='popup-realisateur'>
                                <h3>Réalisateur :</h3>
                                <p>
                                      <strong>Prénom : </strong>".$film->getRealisateur()->getPrenom()."<br>
                                      <strong>Nom : </strong>".$film->getRealisateur()->getNom()."<br>
                                      <strong>Né le : </strong>".$film->getRealisateur()->getBirthDay()."<br>
                                      <strong>Age : </strong>".$film->getRealisateur()->getAge()."<br>
                                    </p>
                                </div>
                                </td>
                                </tr>";
                            }
                        }
                        echo $table .= "</tbody></table>";
                    }
                break; // case "showByGender"


                // Affiche le casting d'un film 
                case "showFilmCasting":
                    if (isset($_POST['selectFilm'])) {
                        // récupère le nom du film sélectionné
                        $name = $_POST['selectFilm']; 
                        $table = "<table>
                        <thead>
                        <tr>
                            <th scope='col' width=300>ACTEUR</th>
                            <th scope='col' width=300>ROLE</th>
                        </tr>
                        </thead>
                        <caption> <h2>Casting du Film :</h2>
                        <h3 id='info-Table'>".$films[$name]->getTitle()."
                        ";
                            // popup pour les infos du film
                            $table .= "<div class='popup' id='popup-film'>
                        <h3>Film :</h3>
                        <p>
                          <strong>Titre : </strong>".$films[$name]->getTitle()."<br>
                          <strong>Date sortie : </strong>".$films[$name]->getStrDateSortie()."<br>
                          <strong>Durée : </strong>".$films[$name]->getDureeHrsMn()."<br>
                          <strong>Genre : </strong>".$films[$name]->getGenre()."<br>
                        </p>
                        </div>
            </h3></caption>
                        <tbody>";
                        // pour chaque casting dans ce film
                        foreach ($films[$name]->getCastings() as $key => $value) {
                            // on affiche les données
                            $table .= "<tr>
                            <td scope='row' id='info-td-acteur'>" . $value->getActeur() . "
                            ";
                            // popup pour les infos de l'acteur
                            $table .= "<div class='popup'>
                            <h3>Acteur :</h3>
                            <p>
                              <strong>Prénom : </strong>".$value->getActeur()->getPrenom()."<br>
                              <strong>Nom : </strong>".$value->getActeur()->getNom()."<br>
                              <strong>Né le : </strong>".$value->getActeur()->getBirthDay()."<br>
                              <strong>Age : </strong>".$value->getActeur()->getAge()."<br>
                            </p>
                        </div>
                </td>
                            <td scope='row' align='center'>" . $value->getRole() . "</td>
                            </tr>";
                        }
                        echo $table .= "</tbody></table>";
                    }
                break;  // case "showFilmCasting"

                default :
                    header("Location:index.php");
                    die();
                break; // case default

            }

        }

        if (isset($_GET['action'])){

            switch($_GET['action']){
    
                case "viewText":
                    echo '<iframe style="height: 100%; width: 100vw"
                    title="Énoncé de l\'exercice Cinéma"
                    src="doc/Cinema.pdf">
                  </iframe>';
                break;

                default :
                    header("Location:index.php");
                    die();
                break; // case default

            }
        }
    ?>
</div>
</main>
<?php include_once "view/footer.php" ?>
</body>
</html>