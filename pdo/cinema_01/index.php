<?php




use Controller\ActeurController;
use Controller\RealisateurController;
use Controller\FilmController;
use Controller\GenreController;
use Controller\CastingController;



spl_autoload_register(function ($class_name) {

    include $class_name . ".php";
});



$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();
$ctrlFilm = new FilmController();
$ctrlGenre = new GenreController();
$ctrlCasting = new CastingController();
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'ListActeurs':
            $ctrlActeur->listActeurs();
            break;

        case 'ListRealisateurs':
            $ctrlRealisateur->listRealisateurs();
            break;

        case 'ListFilms':
            $ctrlFilm->listFilms();
            break;

        case 'ListGenres':
            $ctrlGenre->listGenres();
            break;

        case 'addGenre':
            $ctrlGenre->addGenre();
            break;

        case 'addFilm':
            $ctrlFilm->addFilm();
            break;

        case 'deleteCastingActeur':
            if (isset($_GET['id']) and isset($_GET['idF'])) {
                $ctrlFilm->deleteCastingActeur($_GET['id'], $_GET['idF']);
            }
            break;

        case 'addActeur':
            $ctrlActeur->addActeur();
            break;

        case 'deleteActeur':
            if (isset($_GET['id'])) {
                $ctrlActeur->deleteActeur($_GET['id']);
            }
            break;

        case 'showActeurFilmo':
            if (isset($_GET['id'])) {
                $ctrlActeur->showActeurFilmo($_GET['id']);
            }
            break;

        case 'addRealisateur':
            $ctrlRealisateur->addRealisateur();
            break;

        case 'showCasting':
            $ctrlCasting->showCasting();
            break;

        case 'addCasting':
            if (isset($_GET['id'])) {
                $ctrlCasting->addCasting($_GET['id']);
            }
            break;

        case 'showFilm':
            if (isset($_GET['id'])) {
                $ctrlFilm->showFilm($_GET['id']);
            }
            break;

        case 'showFilmCasting':
            if (isset($_GET['id'])) {
                $ctrlFilm->showFilmCasting($_GET['id']);
            }
            break;

        case 'deleteFilm':
            if (isset($_GET['id'])) {
                $ctrlFilm->deleteFilm($_GET['id']);
            }
            break;

        case 'deleteReal':
            if (isset($_GET['id'])) {
                $ctrlRealisateur->deleteReal($_GET['id']);
            }
            break;

        case 'filmsByGenre':
            if (isset($_GET['id'])) {
                $ctrlGenre->filmsByGenre($_GET['id']);
            }
            break;

        case 'showFilmo':
            if (isset($_GET['id'])) {
                $ctrlRealisateur->showFilmo($_GET['id']);
            }
            break;

        default:
            $ctrlFilm->listFilms();
            break;
    } 
} else {
    $ctrlFilm->listFilms();?>
<?php
}

?>