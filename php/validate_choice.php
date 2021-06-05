<?php

include("config.php");
if (!isset($_SESSION['loggedin'])) {
    header('Location: connexion.php');
    exit();
}
if(protect($debut_inscription)){
    header('Location: index.php');
    exit();
}

function isRealDate($date) { 
    if (false === strtotime($date)) { 
        return false;
    } 
    list($year, $month, $day) = explode('-', $date); 
    return checkdate($month, $day, $year);
}

if (!isset($_POST["Type-choice"], $_POST["replace-choice"], $_POST["gender-choice"], $_POST["arrival-date"], $_POST["arrival-time"], $_POST["departure-date"], $_POST["departure-time"])) {
	header('Location: choice.php?erreur=choice-form');
    exit();
}
if (empty($_POST["Type-choice"]) || empty($_POST["replace-choice"]) || empty($_POST["gender-choice"]) || empty($_POST["arrival-date"]) || empty($_POST["arrival-time"]) || empty($_POST["departure-date"]) || empty($_POST["departure-time"])){
	header('Location: choice.php?erreur=choice-form');
    exit();
}

if ($_POST["Type-choice"] == 2 || $_POST["Type-choice"] == 3) {
    if (!isset($_POST["mate-choice"])) {
        header('Location: choice.php?erreur=choice-form');
        exit();
    }
    if (empty($_POST["mate-choice"])) {
        header('Location: choice.php?erreur=choice-form');
        exit();
    }
    if ($_POST["mate-choice"] == 1)
    {
        if (!isset($_POST["mate-email"])) {
            header('Location: choice.php?erreur=choice-form');
            exit();
        }
        if (empty($_POST["mate-email"])) {
            header('Location: choice.php?erreur=choice-form');
            exit();
        }
        if (!filter_var($_POST['mate-email'], FILTER_VALIDATE_EMAIL)) {
            header('Location: choice.php?erreur=choice-mail');
            exit();
        }
    }
}

if ($_POST["Type-choice"] == 1) {
    if (isset($_POST["mate-choice"])){
        if ($_POST["mate-choice"] == 1) {
            header('Location: choice.php?erreur=mate');
            exit();
        }
    } 
}

if ($_POST["gender-choice"] != 1 && $_POST["gender-choice"] != 2 && $_POST["gender-choice"] != 3) {
    header('Location: choice.php?erreur=choice-gender');
    exit();
}
if ($_POST["Type-choice"] != 1 && $_POST["Type-choice"] != 2 && $_POST["Type-choice"] != 3) {
    header('Location: choice.php?erreur=choice-type');
    exit();
}
if ($_POST["replace-choice"] != 1 && $_POST["replace-choice"] != 0) {
    header('Location: choice.php?erreur=choice-replace');
    exit();
}

if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST["arrival-date"])) {
    header('Location: choice.php?erreur=arrival-date');
    exit();
}

if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST["departure-date"])) {
    header('Location: choice.php?erreur=departure-date');
    exit();
}

if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST["arrival-time"]) == 0) {
    header('Location: choice.php?erreur=arrival-time');
    exit();
}

if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST["departure-time"]) == 0) {
    header('Location: choice.php?erreur=departure-time');
    exit();
}
if(!$_SESSION['a_reserve']){

if ($_POST["mate-choice"] == 1)
{
    $stmt = $con->prepare('INSERT INTO demande (id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee) VALUES (?,?,?,?,?,?,?,?,?,?,0)');
    $stmt->bind_param('iiiissssis', $_SESSION['id'], $_POST['Type-choice'], $_POST['replace-choice'], $_POST['gender-choice'], $_POST['arrival-date'], $_POST['arrival-time'], $_POST['departure-date'], $_POST['departure-time'], $_POST['mate-choice'], $_POST['mate-email']);
    $stmt->execute();
    $stmt->close();
}
else {
    $stmt = $con->prepare('INSERT INTO demande (id_eleve, type_chambre, remplace, gender_choice, arrival_date, arrival_time, departure_date, departure_time, mate, mate_email, validee) VALUES (?,?,?,?,?,?,?,?,?,NULL,0)');
    $stmt->bind_param('iiiissssi', $_SESSION['id'], $_POST['Type-choice'], $_POST['replace-choice'], $_POST['gender-choice'], $_POST['arrival-date'], $_POST['arrival-time'], $_POST['departure-date'], $_POST['departure-time'], $_POST['mate-choice']);
    $stmt->execute();
    $stmt->close();
}


if ($stmt = $con->prepare('SELECT * FROM eleves WHERE id = ?')){
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($stmt = $con->prepare('UPDATE eleves SET a_reserve=1 WHERE id=?')) {
            $stmt->bind_param('i', $_SESSION['id']);
            $stmt->execute();
        }
    }
}
$_SESSION['a_reserve']=1;
$stmt->close();

}
else{

if ($_POST["mate-choice"] == 1)
{
    $stmt = $con->prepare('UPDATE demande SET id_eleve=?, type_chambre=?, remplace=?, gender_choice=?, arrival_date=?, arrival_time=?, departure_date=?, departure_time=?, mate=?, mate_email=?, validee=0 WHERE id_eleve=?');
    $stmt->bind_param('iiiissssisi', $_SESSION['id'], $_POST['Type-choice'], $_POST['replace-choice'], $_POST['gender-choice'], $_POST['arrival-date'], $_POST['arrival-time'], $_POST['departure-date'], $_POST['departure-time'], $_POST['mate-choice'], $_POST['mate-email'], $_SESSION['id']);
    $stmt->execute();
    $stmt->close();
}
else {
    $stmt = $con->prepare('UPDATE demande SET id_eleve=?, type_chambre=?, remplace=?, gender_choice=?, arrival_date=?, arrival_time=?, departure_date=?, departure_time=?, mate=?, mate_email=NULL, validee=0 WHERE id_eleve=?');
    $stmt->bind_param('iiiissssii', $_SESSION['id'], $_POST['Type-choice'], $_POST['replace-choice'], $_POST['gender-choice'], $_POST['arrival-date'], $_POST['arrival-time'], $_POST['departure-date'], $_POST['departure-time'], $_POST['mate-choice'], $_SESSION['id']);
    $stmt->execute();
    $stmt->close();
}

}
$con->close();
header('Location: profil.php');
exit();
?>