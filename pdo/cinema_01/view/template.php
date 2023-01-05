<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <title><?= $titre ?></title>

</head>

<body>
    <?php include_once "./view/header.php" ?>
    <main>
        <div class="menu" id="div-menu">
        <nav id="main-menu">
            <ul>
                <li><a href="index.php?action=ListFilms">Liste des Films</a></li>
                <li><a href="index.php?action=ListActeurs">Liste des Acteurs</a></li>
                <li><a href="index.php?action=ListRealisateurs">Liste des Réalisateurs</a></li>
                <li><a href="index.php?action=ListGenres">Liste des Genres</a></li>
                <li><a href="index.php?action=addGenre">Ajouter un Genre</a></li>
                <li><a href="index.php?action=addActeur">Ajouter un Acteur</a></li>
                <li><a href="index.php?action=addRealisateur">Ajouter un Réalisateur</a></li>
                <li><a href="index.php?action=addFilm">Ajouter un Film</a></li>
                <li><a href="index.php?action=showCasting">Castings</a></li>
            </ul>
        </nav>
    </div>
        <div class="title-container">
            <div class="tableDiv">
                <div id="wrapper" class="uk-container uk-container-expand">
                    <h1><?= $titre_secondaire ?></h1>
                    <div id="contenu">
                        <?= $contenu ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "./view/footer.php" ?>
</body>

</html>