<?php

//---------NOT FOR PROD---------//
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//---------NOT FOR PROD---------//

//include("mailer.php");

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

if (!isset($_POST["Type-choice"], $_POST["replace-choice"], $_POST["arrival-date"], $_POST["arrival-time"], $_POST["departure-date"], $_POST["departure-time"])) {
	exit('Merci de compléter le formulaire d\'inscription.');
}
if (empty($_POST["Type-choice"]) || empty($_POST["replace-choice"]) || empty($_POST["arrival-date"]) || empty($_POST["arrival-time"]) || empty($_POST["departure-date"]) || empty($_POST["departure-time"])){
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
        exit(('Vous ne pouvez pas être deux dans une chambre simple');
    }
}

if ($_POST["Type-choice"] == 1 || $_POST["mate-choice"] == 0) {
    if (!empty($_POST['mate-email']) {
        exit(('Erreur');
    }
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

//TO DO
if ($stmt = $con->prepare('SELECT id, password FROM eleves WHERE mail = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo 'Cet email est déjà utilisé.';
	} else {
		$stmt = $con->prepare('INSERT INTO eleves (prenom, nom, password, mail, tel, admin, activation_code) VALUES (?, ?, ?, ?, ?, 0, ?)');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$uniqid = uniqid();
	    $stmt->bind_param('ssssss', $_POST['prenom'], $_POST['nom'], $password, $_POST['email'], $_POST['tel'], $uniqid);
	    $stmt->execute();

		//send_mail($_POST['email'], $uniqid, $_POST['prenom']);
	    //echo 'Un email vous a été envoyé. Merci de vérifier vos emails pour activer votre compte.';

		//******Only while there is no mailer******//
		header('Location: temp.php?email='.$_POST['email'].'&code='.$uniqid.'');
	    exit();
		//*****************************************//
	}
	$stmt->close();
}

$con->close();
?>