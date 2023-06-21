<?php
// 1- Connexion à la BDD
$pdoManga = new PDO(
    'mysql:host=localhost;
    dbname=tengoku_test', 
    'root',
    '',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    )
);

// 2- Ouverture de session
session_start();

$contenu = "";

require_once('fonction.php')
?>