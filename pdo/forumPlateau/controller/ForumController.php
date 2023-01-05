<?php

namespace Controller;

use App\Session;
use App\Debug;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {


        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "nbTopics" => $topicManager->countTopics(),
                "topics" => $topicManager->findAll(["creationdate", "DESC"])
            ]
        ];
    }


    public function listPosts($id)
    {
        $postManager = new PostManager();

        $topicManager = new TopicManager();
        return [
            // ajoute les données qui seront utilisées dans la vue listPosts
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                // les données du Topic (titre auteur etc.)
                "topic" => $topicManager->findOneById($id),
                // et tous les messages qui lui sont ratachés
                "posts" => $postManager->findPostsByTopicId($id)
            ]
        ];
    }

    // ********************************************************************************
    public function ListUserPosts($id)
    {
        // $user = Session::getUser();
        $this->restrictTo("ROLE_USER");
        $userManager = new UserManager();
        $user = $userManager->findOneById($id);
        // autorise la vue que si l'id correspond à l'id du user en session
        // ou si c'est une session admin
        if (($user && Session::getUser() && Session::getUser()->getId() == $id) || Session::isAdmin()) {
            $postManager = new PostManager();

            return [
                // ajoute les données qui seront utilisées dans la vue listPosts
                "view" => VIEW_DIR . "forum/ListUserPosts.php",
                "data" => [
                    // les données du Topic (titre auteur etc.)
                    "title" => "Liste de tous les messages de ",
                    "subTitle" =>  $user->getPseudo(),
                    // "topic" => $topicManager->findOneById($id),
                    // et tous les messages qui lui sont ratachés
                    "posts" => $postManager->findPostsByUserId(intval($id), ["creationdate", "DESC"])
                ]
            ];
        } else header('Location: index.php');
    }

    public function addTopicForm()
    {
        return [
            "view" => VIEW_DIR . "forum/addTopic.php",
            "data" => ""
        ];
    }

    public function addTopic()
    {
        if (!empty($_POST)) {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $user = Session::getUser();
            $topicId = $topicManager->add([
                "title" => $title,
                "closed" => intval(false), // 0 pour false
                "user_id" => $user->getId()
            ]);

            $message = htmlspecialchars($_POST["message"]);

            $postManager->add([
                "message" => $message,
                "topic_id" => $topicId,
                "user_id" => $user->getId()
            ]);
            // redirection sur la liste des Topics sans risque de renvoyer le formulaire
            // $this->redirectTo("index.php?ctrl=forum", "&action=listTopics");
            header('Location: index.php?ctrl=forum&action=listPosts&id='.$topicId);
            exit();
        }

        return [
            "view" => VIEW_DIR . "forum/addTopic.php",
            "data" => ""
        ];
    }

    public function addPostForm($id)
    {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        if (!$topic->getClosed()) {
            return [
                "view" => VIEW_DIR . "forum/addPost.php",
                "data" => [
                    "id" => $id,
                    "title" => "Ajoute un Post au Topic",
                    "add" => true,
                    "divTitle" => "Ajouter un nouveau message"
                ],
            ];
        } else {
            Session::addFlash("error", "Le sujet est verouillé impossible de poster de nouveaux messages !");

            //return $this->listPosts($id);// 
            header('Location: index.php?ctrl=forum&action=listPosts&id=' . $id);
        }
    }

    public function modifyPostForm($id)
    {
        // $topicManager = new TopicManager();
        // $topic = $topicManager->findOneById($id);
        $postManager = new PostManager();
        $post = $postManager->findPostById($id);
        $message = $post->getMessage();
        if ($post) {
            return [
                "view" => VIEW_DIR . "forum/addPost.php",
                "data" => [
                    "id" => $post->getTopic()->getId(),
                    "messageId" => intval($id),
                    "add" => false,
                    "message" => $message,
                    "title" => "Modifier un message",
                    "divTitle" => "Modifie le message"
                ],
            ];
        } else {
            Session::addFlash("error", "Le sujet est verouillé impossible de poster de nouveaux messages !");

            //return $this->listPosts($id);// 
            header('Location: index.php?ctrl=forum&action=listPosts&id=' . $id);
        }
    }

    public function addPost()
    {
        if (!empty($_POST)) {
            $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $topicId = filter_input(INPUT_POST, "topicId", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $messageId = filter_input(INPUT_POST, "messageId", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $adding = filter_input(INPUT_POST, "adding", FILTER_SANITIZE_NUMBER_INT);
            // var_dump($message);
            if ($message && $topicId) {
                # code...
                $postManager = new PostManager();
                $user = Session::getUser();
                if ($adding) {
                    # code...
                    $postManager->add([
                        "message" => $message,
                        "topic_id" => $topicId,
                        "user_id" => $user->getId()
                    ]);
                } else {
                    $postManager->updatePost($messageId, [
                        "message" => $message
                    ]);
                }

                // redirection sur la liste des Posts sans risque de renvoyer le formulaire
                header('Location: index.php?ctrl=forum&action=listPosts&id=' . $topicId);
                // header('Location: index.php');
                exit();
            }
        }

        return [
            "view" => VIEW_DIR . "forum/addPost.php",
            "data" => ""
        ];
    }

    public function deleteTopic()
    {
        // Première sécurité :
        $this->restrictTo("ROLE_ADMIN");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST)) {
                // Deuxième sécurité :
                // on récupère le token (jeton) de session mis en place au début de cette dernière
                // permet de se prémunir de la faille CSRF
                // Cross-Site Request Forgery
                // le pirate va utiliser l'utilisateur à son insue 
                // pour qu'il click sur un lien falsifié qui exécutera une action non désiré
                $csrfToken = filter_input(INPUT_POST, "csrfToken", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // controle le token de session si différent 
                // c'est qu'on est en présence d'une tentative de CSRF 
                // on déconnecte le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    header('Location: index.php');
                    exit();
                }

                $idtopic = filter_input(INPUT_POST, "idtopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $topicManager = new TopicManager();
                $topicManager->deleteTopic($idtopic);
                header('Location:  index.php?ctrl=forum&action=listTopics');
                exit();
                // return $this->index();
            }
        }
        header('Location:  index.php');
    }

    public function deletePost()
    {
        // Première sécurité :
        // $this->restrictTo("ROLE_ADMIN");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST)) {
                // Deuxième sécurité :
                // on récupère le token (jeton) de session mis en place au début de cette dernière
                // permet de se prémunir de la faille CSRF
                // Cross-Site Request Forgery
                // le pirate va utiliser l'utilisateur à son insue 
                // pour qu'il click sur un lien falsifié qui exécutera une action non désiré
                $csrfToken = filter_input(INPUT_POST, "csrfToken", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // controle le token de session si différent 
                // c'est qu'on est en présence d'une tentative de CSRF 
                // on déconnecte le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    header('Location: index.php');
                    exit();
                }

                $id = filter_input(INPUT_POST, "idpost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $idtopic = filter_input(INPUT_POST, "idtopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $user = Session::getUser();
                $postManager = new PostManager();
                $postManager->delete($id);
                // Debug::debug($idtopic);

                header('Location: index.php?ctrl=forum&action=listPosts&id=' . $idtopic);
                exit();
            }
        }
        header('Location:  index.php');
    }

    public function setTopicSatus()
    {
        // Première sécurité :
        $this->restrictTo("ROLE_ADMIN");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST)) {
                // Deuxième sécurité :
                // on récupère le token (jeton) de session mis en place au début de cette dernière
                // permet de se prémunir de la faille CSRF
                // Cross-Site Request Forgery
                // le pirate va utiliser l'utilisateur à son insue 
                // pour qu'il click sur un lien falsifié qui exécutera une action non désiré
                $csrfToken = filter_input(INPUT_POST, "csrfToken", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // controle le token de session si différent 
                // c'est qu'on est en présence d'une tentative de CSRF 
                // on déconnecte le user de la session et retourne à l'index
                if (!Session::checkToken($csrfToken)) {
                    header('Location: index.php');
                    exit();
                }

                $idtopic = filter_input(INPUT_POST, "idtopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $user = Session::getUser();
                // $locked = false;
                // $locked =  array_key_exists("lockTopic", $_POST);
                $locked =  array_key_exists("lockTopic", $_POST) ? intval(true) : intval(false);

                $topicManager = new TopicManager();
                $topicManager->updateTopicById($idtopic, array("closed" => $locked));
                // Debug::debug($locked);
                // var_dump($locked);
                // Debug::debug($_POST);

                Session::addFlash("success", "Le status du topic a bien été modifié.");
                header('Location: index.php?ctrl=forum&action=listPosts&id=' . $idtopic);
                exit();
            }
        }
        header('Location:  index.php');
    }
}
