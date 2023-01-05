<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Debug;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()
    {
    }

    public function registerForm()
    {

        return [
            "view" => VIEW_DIR . "security/register.php",
            "data" => ""
        ];
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST)) {

                // on récupère le token (jeton) de session mis en place au début de cette dernière
                // permet de se prémunir de la faille CSRF
                // Cross-Site Request Forgery
                // le pirate va utiliser l'utilisateur à son insue 
                // pour qu'il click sur un lien falsifié qui exécutera une action non désiré
                $csrfToken = filter_input(INPUT_POST, "csrf_Token", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // controle le token de session si différent 
                // c'est qu'on est en présence d'une tentative de CSRF 
                // on déconnecte le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    header('Location: index.php');
                    exit();
                }

                // on récupère les données du formulaire et on les "SANITIZE" pour 
                // éviter la faille de type injection SQL
                $nickName = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // sur le password on utilise une regexp (expression régulière)
                // pour controler la longueure et le contenu du mot de passe
                // [A-Za-z0-9] => au moins 1 majuscule 1 minuscule 1 chiffre
                // {8,32} => entre 8 et 32 caractères
                $password = filter_input(
                    INPUT_POST,
                    "password",
                    FILTER_VALIDATE_REGEXP,
                    ["options" => ["regexp" => "/[A-Za-z0-9].{8,32}/"]]
                );

                // on récupère le comfirmPassword
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // pour l'email on utilise un filtre adapté
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

                if ($nickName && $password && $email && $csrfToken) {

                    if ($password == $confirmPassword and strlen($password) >= 8) {
                        $manager = new UserManager();
                        $user = $manager->findOneByPseudo($nickName);
                        if (!$user) {

                            // PASSWORD_DEFAULT utilise la dernière version recommendée par php
                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            if ($manager->add([
                                "pseudo" => $nickName,
                                "email" => $email,
                                "password" => $hash
                            ])) {
                                Session::addFlash('success', "vous êtes bien inscrit");
                                header('Location: index.php');
                                exit();
                                // return [
                                //     "view" => VIEW_DIR . "home.php",
                                // ];
                            }
                        } else {
                            Session::addFlash('error', "le pseudo $nickName existe déjà");
                        }
                    } else {
                        Session::addFlash('error', "le password est trop court ou la confirmation du password a échoué");
                    }
                } elseif (!$password) {
                    Session::addFlash('error', 'Le mot de passe doit contenir au moins une majuscule une minuscule et un chiffre d\'un minimum de 8 caractères');
                } else {
                    Session::addFlash('error', "Erreur de saisie veuillez recommencer");
                }
            }
        }
        return [
            "view" => VIEW_DIR . "security/register.php",
        ];
    }

    public function loginForm()
    {
        return [
            "view" => VIEW_DIR . "security/login.php",
            "data" => ""
        ];
    }

    public function login()
    {
        if (!empty($_POST)) {
            $nickName = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $csrfToken = filter_input(INPUT_POST, "csrf_Token", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($nickName && $password && $csrfToken) {

                // controle le token de session si différent on déconnecte 
                // le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    header('Location: index.php');
                    exit();
                }

                $user = UserManager::getByPseudo($nickName);
                if ($user) {

                    if (password_verify($password, $user->getPassword())) {
                        Session::setUser($nickName);
                        // Session::setUser($user);

                        Session::addFlash("success", "Bienvenue  $nickName");

                        header('Location: index.php');
                        exit();
                    }
                }
            }
        }

        Session::addFlash("error", "Identifiants incorrectes");
        return [
            "view" => VIEW_DIR . "security/login.php",
        ];
    }

    public function logoutForm()
    {
        return [
            "view" => VIEW_DIR . "security/logout.php",
            "data" => ""
        ];
    }

    public function logout()
    {

        Session::setUser(null);
        header('Location: index.php');
    }

    public function profileForm($id)
    {
        $this->restrictTo("ROLE_USER");
        $user = Session::getUser();
        if (($user->getId() <> $id || Session::isAdmin())) {
            $userManager = new UserManager();
            $user = $userManager->findOneById($id);
        } elseif (!$user->getId() == $id) {
            $this->redirectTo("security", "loginForm");
            die();
        }
        return [
            "view" => VIEW_DIR . "security/viewProfile.php",
            "data" => [
                "user" => $user
            ]
        ];
    }

    // public function viewProfile()
    // {
    //     if (!empty($_POST)) {

    //         Session::setUser(null);
    //         return [
    //             "view" => VIEW_DIR . "home.php",
    //         ];
    //     }
    // }

    public function modifyPasswordForm()
    {
        return [
            "view" => VIEW_DIR . "security/modifyPassword.php",
            "data" => ""
        ];
    }

    public function modifyPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST)) {

                // on récupère le token (jeton) de session mis en place au début de cette dernière
                // permet de se prémunir de la faille CSRF
                // Cross-Site Request Forgery
                // le pirate va utiliser l'utilisateur à son insue 
                // pour qu'il click sur un lien falsifié qui exécutera une action non désiré
                $csrfToken = filter_input(INPUT_POST, "csrf_Token", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // controle le token de session si différent 
                // c'est qu'on est en présence d'une tentative de CSRF 
                // on déconnecte le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    header('Location: index.php');
                    exit();
                }

                $msg = "";
                // if (!empty($_POST)) {

                $actualPassword = filter_input(INPUT_POST, "actualPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $password = filter_input(
                    INPUT_POST,
                    "password",
                    FILTER_VALIDATE_REGEXP,
                    ["options" => ["regexp" => "/[A-Za-z0-9].{8,32}/"]]
                );
                $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($actualPassword && $password) {

                    $user = Session::getUser();
                    if (password_verify($password, $user->getPassword())) {

                        if ($password == $confirmPassword and strlen($password) >= 8) {

                            $manager = new UserManager();
                            $user = Session::getUser();

                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            if ($manager->updateUser($user->getId(), [
                                "password" => $hash
                            ])) {
                                Session::addFlash('success', "Votre nouveau mot de passe et bien pris en compte");
                                header('Location: index.php');
                                exit();
                                // return [
                                //     "view" => VIEW_DIR . "home.php",
                                // ];
                            }
                        } else
                            $msg = "le password est trop court ou la confirmation du password a échoué";
                    } else
                        $msg =  "Erreur de saisie veuillez recommencer";
                } elseif (!$password) {
                    $msg =  'Le mot de passe doit contenir au moins une majuscule une minuscule et un chiffre d\'un minimum de 8 caractères';
                } else
                    $msg =  "Erreur de saisie veuillez recommencer";
                // Azertyuiop1
            }
            Session::addFlash('error', $msg);
            return [
                "view" => VIEW_DIR . "security/modifyPassword.php",
            ];
        }
        header('Location: index.php');
    }

    public function deleteUser()
    {
        $this->restrictTo("ROLE_USER");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST)) {

                // on récupère le token (jeton) de session mis en place au début de cette dernière
                // permet de se prémunir de la faille CSRF
                // Cross-Site Request Forgery
                // le pirate va utiliser l'utilisateur à son insue 
                // pour qu'il click sur un lien falsifié qui exécutera une action non désiré
                $csrfToken = filter_input(INPUT_POST, "csrfToken", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                Debug::debug($_POST);
                // controle le token de session si différent 
                // c'est qu'on est en présence d'une tentative de CSRF 
                // on déconnecte le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    // header('Location: index.php');
                    $this->redirectTo("security", "loginForm");
                    die();
                }

                $userId = $_POST["userId"];
                $user = Session::getUser();
                if ($user->getId() == $userId || Session::isAdmin()) {
                    $userManager = new UserManager();

                    if ($userManager->delete($userId)) {
                        // Session::setUser(null);
                        return [
                            "view" => VIEW_DIR . "forum/goodby.html"
                        ];
                    };
                }
            }
        }
    }
}
