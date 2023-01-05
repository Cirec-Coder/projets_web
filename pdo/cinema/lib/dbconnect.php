<?php
$dsn = 'mysql:dbname=exercice_cinema;host=localhost';
$user = 'root';
$password = '';
try {
$db = new PDO($dsn, $user, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
echo 'Connexion échouée : ' . $e->getMessage();
}