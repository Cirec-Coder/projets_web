<?php



// namespace est un moyen de séparer des éléments au sein du code dans le but 
// d'éviter les collisions dues à des duplication de noms
namespace Model;



// Les classes définies comme abstraites ne peuvent pas être instanciées
// Toute classe contenant au moins une méthode abstraite doit-être aussi abstraite.
abstract class Connect
{
    // Informations de la base de données
    const HOST = '127.0.0.1';
    const DBNAME = 'exercice_cinema';
    const USERNAME = 'root';
    const PASSWORD = '';

    public static function seConnecter()
    {
        try {
            return new \PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=utf8",
                self::USERNAME,
                self::PASSWORD
            );
        } catch (\PDOException $ex) {
            return $ex->getMessage();
        }
    }
}
