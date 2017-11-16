<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Afficher les erreurs et les avertissements
error_reporting(E_ALL);

// try
// {
//     $bdd = new PDO('mysql:host=;dbname=ordiassi_quizz;charset=utf8', 'ordiassi_admin', 'Kfixwoax68');
// }
// catch (Exception $e)
// {
//     die('Erreur : ' . $e->getMessage());
// }

// try
// {
//     $bdd = new PDO('mysql:host=;bdname=quizz_bdd;charset=utf8', 'root', 'kfixwoax');
// }
// catch (Exception $e)
// {
//     die('Erreur : ' . $e->getMessage());
// }

include("model/SPDO.php");
include("controller/DataManager.php");

$bdd = SPDO::getInstance()->getPDO();

$manager = new DataManager($bdd);