<?php

namespace App;

use Model\Managers\UserManager;

class Session
{


    private static $categories = ['error', 'success'];

    /**
     *   ajoute un message en session, dans la catégorie $categ
     */
    public static function addFlash($categ, $msg)
    {
        $_SESSION[$categ] = $msg;
    }

    /**
     *   renvoie un message de la catégorie $categ, s'il y en a !
     */
    public static function getFlash($categ)
    {

        if (isset($_SESSION[$categ])) {
            $msg = "&emsp;".$_SESSION[$categ];
            unset($_SESSION[$categ]);
        } else $msg = "";

        return $msg;
    }

    /**
     *   met un user dans la session (pour le maintenir connecté)
     */
    public static function setUser($user)
    {
        $_SESSION["user"] = $user;
        if (!$user or empty($user)) {
            unset($_SESSION['_token']);
        }
    }

    public static function getUser()
    {
        //***************************** */
        return (isset($_SESSION['user'])) ? UserManager::getByPseudo($_SESSION['user']) : false;
    }

    public static function isAdmin()
    {
        if (self::getUser() && self::getUser()->hasRole("ROLE_ADMIN")) {
            return true;
        }
        return false;
    }

    public static function getToken()
    {
        return (isset($_SESSION['_token'])) ? $_SESSION['_token'] : false;
    }

    public static function checkToken($token)
    {
        // return (isset($_SESSION['_token']) && $_SESSION['_token'] == $token) ? true : self::setUser(null); false;
        $result = false;
        $_token = self::getToken();
        if ($_token) {
            $result = $_token == $token;
            if (!$result) {
                self::setUser(null);
            }
        }
        return $result;
    }
}
