<?php

//---------NOT FOR PROD---------//
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//---------NOT FOR PROD---------//

function isRealDate($date) { 
    if (false === strtotime($date)) { 
        return false;
    } 
    list($year, $month, $day) = explode('-', $date); 
    return checkdate($month, $day, $year);
}

$db_password = $_ENV["mysql_password"];
$con = new mysqli('db', 'admissibles_user', $db_password, 'admissibles');
if ($con->connect_error) {
    die('Erreur lors de la connexion à la base de donnée: ' . $con->connect_error);
}

if (!isset($_POST["Type-choice"], $_POST["replace-choice"], $_POST["gender-choice"], $_POST["arrival-date"], $_POST["arrival-time"], $_POST["departure-date"], $_POST["departure-time"])) {
	exit('Merci de compléter le formulaire d\'inscription.');
}
if (empty($_POST["Type-choice"]) || empty($_POST["replace-choice"]) || $_POST["gender-choice"] || empty($_POST["arrival-date"]) || empty($_POST["arrival-time"]) || empty($_POST["departure-date"]) || empty($_POST["departure-time"])){
	exit('Merci de compléter le formulaire d\'inscription.');
}


if ($_POST["Type-choice"] == 2 || $_POST["Type-choice"] == 3) {
    if !isset($_POST["mate-choice"]) {
        exit(('Merci de compléter le formulaire d\'inscription.');
    }
    if (empty($_POST["mate-choice"]) {
        exit('Merci de compléter le formulaire d\'inscription.');
    }
    if ($_POST["mate-choice"] == 1)
    {
        if (!isset($_POST["mate-email"])) {
            exit('Merci de compléter le formulaire d\'inscription.');
        }
        if (empty($_POST["mate-email"])) {
            exit('Merci de compléter le formulaire d\'inscription.');
        }
        if (!filter_var($_POST['mate-email'], FILTER_VALIDATE_EMAIL)) {
            exit('Adresse email incorrecte.');
        }
    }
}

if ($_POST["Type-choice"] == 1) {
    if ($_POST["mate-choice"] == 1) {
        exit('Vous ne pouvez pas être deux dans une chambre simple');
    }
}

if ($_POST["Type-choice"] == 1 || $_POST["mate-choice"] == 0) {
    if (!empty($_POST['mate-email']) {
        exit('Erreur');
    }
}

if ($_POST["gender-choice"] != 1 && $_POST["gender-choice"] != 2 && $_POST["gender-choice"] != 3) {
    exit("Genre incorrect")
}

if ($_POST["Type-choice"] != 1 && $_POST["Type-choice"] != 2 && $_POST["Type-choice"] != 3) {
    exit('Type incorrect.');
}
if ($_POST["replace-choice"] != 1 && $_POST["replace-choice"] != 0) {
    exit('Choix incorrect.');
}
if (isRealDate($_POST["arrival-date"]) {
    exit('Date incorrecte.');
}
if (isRealDate($_POST["departure-date"]) {
    exit('Date incorrecte.');
}

if (preg_match("([01]?[0-9]|2[0-3]):[0-5][0-9]", $_POST["arrival-time"]) == 0) {
    exit('Heure incorrecte.')
}

if (preg_match("([01]?[0-9]|2[0-3]):[0-5][0-9]", $_POST["departure-time"]) == 0) {
    exit('Heure incorrecte.')
}

$stmt = $con->prepare('INSERT INTO demande (id_eleve, type, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email) VALUES (?,?,?,?,?,?,?,?,?,?)');
if ("mate-choice" == 1)
{
    $stmt->bind_param('iiiissssis', $_SESSION["id"], $_POST['type'], $_POST["gender-choice"], $_POST["replace-choice"], $_POST["arrival-date"], $_POST["arrival-time"], $_POST["departure-date"], $_POST["departure-time"], $_POST["mate"], $_POST["mate_email"]);
} else {
    $stmt->bind_param('iiiissssis', $_SESSION["id"], $_POST['type'], $_POST["gender-choice"], $_POST["replace-choice"], $_POST["arrival-date"], $_POST["arrival-time"], $_POST["departure-date"], $_POST["departure-time"], $_POST["mate"], NULL);    
}
$stmt->execute();
$stmt->close();
$con->close();
?>