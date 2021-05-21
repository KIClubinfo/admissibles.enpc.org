<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: connexion.php');
    exit();
}

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
if (empty($_POST["Type-choice"]) || empty($_POST["replace-choice"]) || empty($_POST["gender-choice"]) || empty($_POST["arrival-date"]) || empty($_POST["arrival-time"]) || empty($_POST["departure-date"]) || empty($_POST["departure-time"])){
	exit('Merci de compléter le formulaire d\'inscription.');
}

if ($_POST["Type-choice"] == 2 || $_POST["Type-choice"] == 3) {
    if (!isset($_POST["mate-choice"])) {
        exit('Merci de compléter le formulaire d\'inscription.');
    }
    if (empty($_POST["mate-choice"])) {
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
    if (isset($_POST["mate-choice"])){
        if ($_POST["mate-choice"] == 1) {
            exit('Vous ne pouvez pas être deux dans une chambre simple');
        }
    } 
}

if ($_POST["gender-choice"] != 1 && $_POST["gender-choice"] != 2 && $_POST["gender-choice"] != 3) {
    exit("Erreur de saisie.");
}

if ($_POST["Type-choice"] != 1 && $_POST["Type-choice"] != 2 && $_POST["Type-choice"] != 3) {
    exit('Erreur de saisie.');
}
if ($_POST["replace-choice"] != 1 && $_POST["replace-choice"] != 0) {
    exit('Erreur de saisie.');
}

if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST["arrival-date"])) {
    exit('Date incorrecte.');
}

if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST["departure-date"])) {
    exit('Date incorrecte.');
}

if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST["arrival-time"]) == 0) {
    exit('Heure incorrecte.');
}

if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST["departure-time"]) == 0) {
    exit('Heure incorrecte.');
}

if ($_POST["mate-choice"] == 1)
{
    $stmt = $con->prepare('INSERT INTO demande (id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee) VALUES (?,?,?,?,?,?,?,?,?,?,0)');
    $stmt->bind_param('iiiissssis', $_SESSION['id'], $_POST['Type-choice'], $_POST['gender-choice'], $_POST['replace-choice'], $_POST['arrival-date'], $_POST['arrival-time'], $_POST['departure-date'], $_POST['departure-time'], $_POST['mate-choice'], $_POST['mate-email']);
    $stmt->execute();
    $stmt->close();
    $con->close();
}
else {
    $stmt = $con->prepare('INSERT INTO demande (id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee) VALUES (?,?,?,?,?,?,?,?,?,NULL,0)');
    $stmt->bind_param('iiiissssi', $_SESSION['id'], $_POST['Type-choice'], $_POST['gender-choice'], $_POST['replace-choice'], $_POST['arrival-date'], $_POST['arrival-time'], $_POST['departure-date'], $_POST['departure-time'], $_POST['mate-choice']);
    $stmt->execute();
    $stmt->close();
    $con->close();
}

header('Location: profil.php');
exit();
?>